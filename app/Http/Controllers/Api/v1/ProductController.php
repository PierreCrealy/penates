<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::with(['movements', 'storages'])->get());
    }

    public function store(ProductRequest $request)
    {
        $data = [
            'name'       => $request->input('name'),
            'quantity'   => $request->input('quantity'),
            'expired_at' => $request->input('expired_at'),
        ];

        return new ProductResource(Product::create($data));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load(['movements', 'storages']));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = [
            'name'       => $request->input('name'),
            'quantity'   => $request->input('quantity'),
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
