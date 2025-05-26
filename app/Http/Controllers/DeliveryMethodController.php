<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Models\DeliveryMethod;
use Illuminate\Http\Request;

class DeliveryMethodController extends Controller
{
    public function db_enums()
    {
        $DeliveryMethod = app(DeliveryMethod::class);
        $enums = [
            'statuses'    => Database::getEnum($DeliveryMethod, 'status'),
        ];
        return $enums;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('delivery-method.index', [
            'deliveryMethods' => DeliveryMethod::all()
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


            $deliveryMethod = DeliveryMethod::create($validated);

            return response()->json([
                'success' => 'Delivery method created successfully',
                'id' => $deliveryMethod->id,
            ], 201);

        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()]);
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
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryMethod $deliveryMethod)
    {
        //
    }
}
