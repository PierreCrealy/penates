<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::with(['movements', 'storages'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => ['required'],
            'expired_at' => ['required', 'date'],
        ]);

        $data = [
            'name'       => $request->input('name'),
            'expired_at' => $request->input('expired_at'),
        ];

        return new ProductResource(Product::create($data));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load(['movements', 'storages']));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'       => ['required'],
            'expired_at' => ['required', 'date'],
        ]);

        $data = [
            'name'       => $request->input('name'),
            'expired_at' => $request->input('expired_at'),
        ];

        $product->update($data);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json();
    }
}
