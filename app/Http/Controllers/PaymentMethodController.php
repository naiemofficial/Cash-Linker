<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function db_enums()
    {
        $PaymentMethod = app(PaymentMethod::class);
        $enums = [
            'statuses'    => Database::getEnum($PaymentMethod, 'status'),
        ];
        return $enums;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment-method.index', [
            'paymentMethods' => PaymentMethod::all()
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
                'type'          => ['required', 'string'],
                'category'      => ['required', 'string'],
                'description'   => ['nullable', 'string'],
            ]);


            $PaymentMethod = PaymentMethod::create($validated);

            return response()->json([
                'success' => 'Payment method created successfully',
                'id' => $PaymentMethod->id,
            ], 201);

        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $PaymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $PaymentMethod)
    {
        return view('payment-method.edit', [
            'paymentMethod' => $PaymentMethod,
            ...$this->db_enums()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $PaymentMethod)
    {
        try {
            $validated = $request->validate([
                'logo'          => ['required', 'url'],
                'name'          => ['required', 'string', 'max:255'],
                'account_no'    => ['required', 'numeric'],
                'type'          => ['required', 'string'],
                'category'      => ['required', 'string'],
                'description'   => ['nullable', 'string'],
                'status'        => ['required', 'string'],
            ]);


            $PaymentMethod->update($validated);

            return response()->json([
                'success' => 'Payment method updated successfully',
            ], 200);
        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $PaymentMethod)
    {
        //
    }
}
