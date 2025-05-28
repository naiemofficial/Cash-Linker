<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Livewire\Message\Index as MessageIndex;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function db_enums()
    {
        $Order = app(Order::class);
        $enums = [
            'statuses'    => Database::getEnum($Order, 'status'),
        ];
        return $enums;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trashPage = request()->segment(3) === 'trash';
        $query = $trashPage
            ? Auth::user()->orders(['onlyTrashed' => true])
            : Auth::user()->orders();

        return view('order.index', [
            'orders' => $query->paginate(15),
            'trash_count' => Auth::user()->orders(['onlyTrashed' => true])->count(),
            'trashPage' => $trashPage,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create', [
            'products' => Product::orderBy('created_at', 'desc')->paginate(5),
            ...$this->db_enums()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, bool $redirect = false)
    {
        try {
            if(Auth::user()->role != 'administrator'){
                throw new \Exception('Unauthorized access to delete the order.');
            }

            $order->delete();
            $message = [ 'pending' => 'Order moved to trash' ];

            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('order.index');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPermanent(int $orderID, bool $redirect = false)
    {
        try {
            if(Auth::user()->role != 'administrator'){
                throw new \Exception('Unauthorized access to delete the order permanently.');
            }

            $order = Order::withTrashed()->findOrFail($orderID);
            $order->forceDelete();
            $message = [ 'success' => 'Order deleted successfully' ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('order.index.trash');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $orderID, bool $redirect = false)
    {
        try {
            if(Auth::user()->role != 'administrator'){
                throw new \Exception('Unauthorized access to restore the order.');
            }

            $order = Order::withTrashed()->findOrFail($orderID);
            $order->restore();
            $message = ['success' => 'Order restored successfully'];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('order.index.trash');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            $message = [ 'error' => $e->getMessage() ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('order.index.trash');
            } else {
                return response()->json($message, 500);
            }
        }
    }
}
