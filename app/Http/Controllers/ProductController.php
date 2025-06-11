<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use App\Livewire\Message\Index as MessageIndex;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $trashPage = (request()->segment(3) === 'trash');
        $query = $trashPage ? Product::onlyTrashed() : Product::query();

        return view('product.index', [
            'products' => $query->orderBy('created_at', 'desc')->paginate(15),
            'trash_count' => Product::onlyTrashed()->count(),
            'trashPage' => $trashPage,
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
                'price'        => ['required', 'numeric'],
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
                'price'        => ['required', 'numeric'],
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
    public function destroy(Product $product, bool $redirect = false)
    {
        try {
            $product->delete();
            $message = [ 'pending' => 'Product moved to trash' ];

            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('product.index');
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
    public function destroyPermanent(int $productID, bool $redirect = false)
    {
        try {
            $product = Product::withTrashed()->findOrFail($productID);
            $product->forceDelete();
            $message = [ 'success' => 'Product deleted successfully' ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('product.index.trash');
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
    public function restore(int $productID, bool $redirect = false)
    {
        try {
            $product = Product::withTrashed()->findOrFail($productID);
            $product->restore();
            $message = ['success' => 'Product restored successfully'];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('product.index.trash');
            } else {
                return response()->json($message, 200);
            }
        } catch (\Exception $e) {
            $message = [ 'error' => $e->getMessage() ];
            if($redirect){
                MessageIndex::refresh($message);
                return redirect()->route('product.index.trash');
            } else {
                return response()->json($message, 500);
            }
        }
    }
}
