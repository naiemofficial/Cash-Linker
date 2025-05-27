<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Livewire\Message\Index as MessageIndex;
use App\Models\DeliveryMethod;
use Illuminate\Http\Request;

class DeliveryMethodController extends Controller
{
    public function db_enums()
    {
        $deliveryMethod = app(DeliveryMethod::class);
        $enums = [
            'statuses'    => Database::getEnum($deliveryMethod, 'status'),
        ];
        return $enums;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trashPage = (request()->segment(3) === 'trash');
        $query = $trashPage ? DeliveryMethod::onlyTrashed() : DeliveryMethod::query();

        return view('delivery-method.index', [
            'deliveryMethods' => $query->orderBy('created_at', 'desc')->paginate(15),
            'trash_count' => DeliveryMethod::onlyTrashed()->count(),
            'trashPage' => $trashPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('delivery-method.create', $this->db_enums());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'cost' => ['required', 'numeric'],
                'details' => ['nullable', 'string'],
            ]);


            $DeliveryMethod = DeliveryMethod::create($validated);

            return response()->json([
                'success' => 'Delivery method created successfully',
                'id' => $DeliveryMethod->id,
            ], 201);

        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryMethod $deliveryMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryMethod $deliveryMethod)
    {
        return view('delivery-method.edit', [
            'deliveryMethod' => $deliveryMethod,
            ...$this->db_enums()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryMethod $deliveryMethod)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'cost' => ['required', 'numeric'],
                'details' => ['nullable', 'string'],
                'status' => ['required', 'string']
            ]);


            $deliveryMethod->update($validated);

            return response()->json([
                'success' => 'Delivery method updated successfully',
            ], 200);
        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryMethod $deliveryMethod, bool $redirect = false)
    {
        try {
            $deliveryMethod->delete();
            $message = [ 'pending' => 'Delivery method moved to trash' ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('delivery-method.index');
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
    public function destroyPermanent(int $deliveryMethodID, bool $redirect = false)
    {
        try {
            $deliveryMethod = DeliveryMethod::withTrashed()->findOrFail($deliveryMethodID);
            $deliveryMethod->forceDelete();
            $message = [ 'success' => 'Delivery method deleted successfully' ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('delivery-method.index.trash');
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
    public function restore(int $deliveryMethodID, bool $redirect = false)
    {
        try {
            $deliveryMethod = DeliveryMethod::withTrashed()->findOrFail($deliveryMethodID);
            $deliveryMethod->restore();
            $message = ['success' => 'Delivery method restored successfully'];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('delivery-method.index.trash');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            $message = [ 'error' => $e->getMessage() ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('delivery-method.index.trash');
            } else {
                return response()->json($message, 500);
            }
        }
    }
}
