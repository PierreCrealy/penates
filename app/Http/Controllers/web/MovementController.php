<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovementRequest;
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

    public function update(MovementRequest $request, Movement $movement)
    {
        $data = [
            'product_id' => $request->input('product_id'),
            'storage_id' => $request->input('storage_id'),
            'quantity'   => $request->input('quantity'),
            'before'     => $request->input('before'),
            'after'      => $request->input('after'),
        ];

        $movement->update($data);

        return Inertia::render('movements/update', compact('movement'));
    }

    public function create()
    {
        return Inertia::render('movements/create');
    }

    public function store(MovementRequest $request)
    {
        $data = [
            'product_id' => $request->input('product_id'),
            'storage_id' => $request->input('storage_id'),
            'quantity'   => $request->input('quantity'),
            'before'     => $request->input('before'),
            'after'      => $request->input('after'),
        ];

        Movement::create($data);

        return redirect()->route('movements.index');
    }

    public function destroy(Movement $movement)
    {
        $movement->delete();

        return redirect()->route('movements.index');
    }

}
