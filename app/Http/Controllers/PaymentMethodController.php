<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Livewire\Message\Index as MessageIndex;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function db_enums()
    {
        $PaymentMethod = app(PaymentMethod::class);
        $enums = [
            'types'      => Database::getEnum($PaymentMethod, 'type'),
            'categories'  => Database::getEnum($PaymentMethod, 'category'),
            'statuses'    => Database::getEnum($PaymentMethod, 'status'),
        ];
        return $enums;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trashPage = (request()->segment(3) === 'trash');
        $query = $trashPage ? PaymentMethod::onlyTrashed() : PaymentMethod::query();

        return view('payment-method.index', [
            'paymentMethods' => $query->orderBy('created_at', 'desc')->paginate(15),
            'trash_count' => PaymentMethod::onlyTrashed()->count(),
            'trashPage' => $trashPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment-method.create', $this->db_enums());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'logo'          => ['required', 'url'],
                'name'          => ['required', 'string', 'max:255'],
                'account_no'    => ['required', 'numeric'],
                'account_name'  => ['required', 'string', 'max:255'],
                'type'          => ['required', 'string'],
                'category'      => ['required', 'string'],
                'swift_code'    => ['nullable', 'string', 'min:8', 'max:11'],
                'description'   => ['nullable', 'string'],
            ]);


            $PaymentMethod = PaymentMethod::create($validated);

            return response()->json([
                'success' => 'Payment method created successfully',
                'id' => $PaymentMethod->id,
            ], 201);

        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment-method.edit', [
            'paymentMethod' => $paymentMethod,
            ...$this->db_enums()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        try {
            $validated = $request->validate([
                'logo'          => ['required', 'url'],
                'name'          => ['required', 'string', 'max:255'],
                'account_no'    => ['required', 'numeric'],
                'account_name'  => ['required', 'string', 'max:255'],
                'type'          => ['required', 'string'],
                'category'      => ['required', 'string'],
                'swift_code'    => ['nullable', 'string', 'min:8', 'max:11'],
                'description'   => ['nullable', 'string'],
                'status'        => ['required', 'string'],
            ]);


            $paymentMethod->update($validated);

            return response()->json([
                'success' => 'Payment method updated successfully',
            ], 200);
        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod, bool $redirect = false)
    {
        try {
            $paymentMethod->delete();
            $message = [ 'pending' => 'Payment method moved to trash' ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('payment-method.index');
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
    public function destroyPermanent(int $paymentMethodID, bool $redirect = false)
    {
        try {
            $paymentMethod = PaymentMethod::withTrashed()->findOrFail($paymentMethodID);
            $paymentMethod->forceDelete();
            $message = [ 'success' => 'Payment method deleted successfully' ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('payment-method.index.trash');
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
    public function restore(int $paymentMethodID, bool $redirect = false)
    {
        try {
            $paymentMethod = PaymentMethod::withTrashed()->findOrFail($paymentMethodID);
            $paymentMethod->restore();
            $message = ['success' => 'Payment method restored successfully'];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('payment-method.index.trash');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            $message = [ 'error' => $e->getMessage() ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('payment-method.index.trash');
            } else {
                return response()->json($message, 500);
            }
        }
    }
}
