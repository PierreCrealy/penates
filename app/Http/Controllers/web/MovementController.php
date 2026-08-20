<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovementController extends Controller
{
    public function index()
    {
        $movements = Movement::with(['product', 'storage'])->get();

        return Inertia::render('movements/index', compact('movements'));
    }

    public function show(Movement $movement)
    {
        return Inertia::render('movements/show', compact('movement'));
    }

    public function update(Request $request, Movement $movement)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'storage_id' => ['required', 'exists:storages,id'],
            'quantity'   => ['required', 'integer'],
            'type'       => ['required'],
        ]);

        $movement->update($request->only('product_id', 'storage_id', 'quantity', 'type'));

        return Inertia::render('movements/update', compact('movement'));
    }

    public function create()
    {
        return Inertia::render('movements/create');
    }

    public function store(Request $request)
    {
        $request->validate([
                    'product_id' => ['required', 'exists:products,id'],
                    'storage_id' => ['required', 'exists:storages,id'],
                    'quantity'   => ['required', 'integer'],
                    'type'       => ['required'],
                ]);

        Movement::create($request->only('product_id', 'storage_id', 'quantity', 'type'));

        return redirect()->route('movements.index');
    }

    public function destroy(Movement $movement)
    {
        $movement->delete();

        return redirect()->route('movements.index');
    }

}
