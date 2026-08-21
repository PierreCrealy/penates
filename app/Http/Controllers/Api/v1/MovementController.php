<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovementRequest;
use App\Http\Resources\MovementResource;
use App\Models\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function index()
    {
        return MovementResource::collection(Movement::with(['product', 'storage'])->get());
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

        return new MovementResource(Movement::create($data));
    }

    public function show(Movement $movement)
    {
        return new MovementResource($movement->load(['product', 'storage']));
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

        return new MovementResource($movement);
    }

    public function destroy(Movement $movement)
    {
        $movement->delete();

        return response()->json();
    }
}
