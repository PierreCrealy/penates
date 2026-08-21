<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['movements', 'storages'])->get();

        return Inertia::render('products/index', compact('products'));
    }

    public function show(Product $product)
    {
        return Inertia::render('products/show', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = [
            'name'       => $request->input('name'),
            'quantity'   => $request->input('quantity'),
            'expired_at' => $request->input('expired_at'),
        ];

        $product->update($data);
        $product->storages()->sync($request->input('storages'));

        return Inertia::render('products/update', compact('product'));
    }

    public function create()
    {
        return Inertia::render('products/create');
    }

    public function store(ProductRequest $request)
    {
        $data = [
            'name'       => $request->input('name'),
            'quantity'   => $request->input('quantity'),
            'expired_at' => $request->input('expired_at'),
        ];

        $newProduct = Product::create($data);
        $newProduct->storages()->attach($request->input('storages'));

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }

}
