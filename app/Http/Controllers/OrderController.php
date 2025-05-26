<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Models\Order;
use Illuminate\Http\Request;

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
        return view('order.index', [
            'orders' => Order::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create', $this->db_enums());
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
    public function destroy(Order $order)
    {
        //
    }
}
