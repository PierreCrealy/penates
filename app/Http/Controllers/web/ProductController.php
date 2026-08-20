<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
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

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'           => ['required'],
            'quantity'       => ['required', 'numeric'],
            'expired_at'     => ['required', 'date'],
            'movements'      => ['nullable', 'array'],
            'movements.*.id' => ['nullable', 'exists:movements,id'],
            'storages'       => ['nullable', 'array'],
            'storages.*.id'  => ['nullable', 'exists:storages,id'],
        ]);

        $product->update($request->only('name', 'quantity', 'expired_at'));
        $product->storages()->sync($request->input('storages'));

        return Inertia::render('products/update', compact('product'));
    }

    public function create()
    {
        return Inertia::render('products/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => ['required'],
            'quantity'       => ['required', 'numeric'],
            'expired_at'     => ['required', 'date'],
            'movements'      => ['nullable', 'array'],
            'movements.*.id' => ['nullable', 'exists:movements,id'],
            'storages'       => ['nullable', 'array'],
            'storages.*.id'  => ['nullable', 'exists:storages,id'],
        ]);

        $newProduct = Product::create($request->only('name', 'quantity', 'expired_at'));
        $newProduct->storages()->attach($request->input('storages'));

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }

}
