<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovementResource;
use App\Models\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function index()
    {
        return MovementResource::collection(Movement::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'numeric'],
            'storage_id' => ['required', 'numeric'],
            'quantity'   => ['required', 'numeric'],
            'before'     => ['required', 'numeric'],
            'after'      => ['required', 'numeric'],
        ]);

        $data = [
            'product_id' => $request->input('product_id'),
            'storage_id' => $request->input('storage_id'),
            'quantity'   => $request->input('quantity'),
            'before'     => $request->input('before'),
            'after'      => $request->input('after'),
        ];

        return new MovementResource(Movement::create($data));
    }

    public function show(Movement $movement)
    {
        return new MovementResource($movement);
    }

    public function update(Request $request, Movement $movement)
    {
        $request->validate([
            'product_id' => ['required', 'numeric'],
            'storage_id' => ['required', 'numeric'],
            'quantity'   => ['required', 'numeric'],
            'before'     => ['required', 'numeric'],
            'after'      => ['required', 'numeric'],
        ]);

        $data = [
            'product_id' => $request->input('product_id'),
            'storage_id' => $request->input('storage_id'),
            'quantity'   => $request->input('quantity'),
            'before'     => $request->input('before'),
            'after'      => $request->input('after'),
        ];

        $movement->update($data);

        return new MovementResource($movement);
    }

    public function destroy(Movement $movement)
    {
        $movement->delete();

        return response()->json();
    }
}
