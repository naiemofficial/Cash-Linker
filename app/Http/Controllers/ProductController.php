<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function db_enums()
    {
        $Product = app(Product::class);
        $enums = [
            'origins'       => Database::getEnum($Product, 'origin'),
            'values'        => Database::getEnum($Product, 'value'),
            'types'         => Database::getEnum($Product, 'type'),
            'categories'    => Database::getEnum($Product, 'category'),
            'statuses'      => Database::getEnum($Product, 'status'),
            'default'   => [
                'origin'    => Database::getEnum($Product, 'origin', ['default' => true]),
                'status'    => Database::getEnum($Product, 'status', ['default' => true]),
            ],
        ];
        return $enums;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product.index', [
            'products' => Product::orderBy('created_at', 'desc')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create', $this->db_enums());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'status'        => ['required', 'string'],
                'name'          => ['required', 'string', 'max:255'],
                'value'         => ['required', 'numeric'],
                'category'      => ['required', 'string', 'max:255'],
                'type'          => ['required', 'string', 'max:255'],
                'year'          => ['nullable', 'numeric'],
                'amount'        => ['required', 'numeric'],
                'commission'    => ['required', 'numeric'],
                'image'         => ['nullable', 'url'],
                'description'   => ['nullable', 'string'],
            ]);

            $product = Product::create($validated);

            return response()->json([
                'success' => 'Product created successfully',
                'id' => $product->id,
            ], 201);

        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()], 400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product,
            ...$this->db_enums()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'status'        => ['required', 'string'],
                'origin'        => ['required', 'string'],
                'name'          => ['required', 'string', 'max:255'],
                'value'         => ['required', 'numeric'],
                'category'      => ['required', 'string', 'max:255'],
                'type'          => ['required', 'string', 'max:255'],
                'year'          => ['nullable', 'numeric'],
                'amount'        => ['required', 'numeric'],
                'commission'    => ['required', 'numeric'],
                'image'         => ['nullable', 'url'],
                'description'   => ['nullable', 'string'],
            ]);

            // dd($validated);

            $product->update($validated);

            return response()->json([
                'success' => 'Product updated successfully',
            ], 200);
        } catch (\Exception $error){
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
