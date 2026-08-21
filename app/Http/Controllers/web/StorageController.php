<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorageRequest;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class StorageController extends Controller
{
    public function index()
    {
        $storages = Storage::with(['products'])->get();

        return Inertia::render('storages/index', compact('storages'));
    }

    public function show(Storage $storage)
    {
        return Inertia::render('storages/show', compact('storage'));
    }

    public function update(StorageRequest $request, Storage $storage)
    {
        $storage->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
        ]);

        $storage->products()->sync($request->input('products'));

        return Inertia::render('storages/update', compact('storage'));
    }

    public function create()
    {
        return Inertia::render('storages/create');
    }

    public function store(StorageRequest $request)
    {
        $newStorage = Storage::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
        ]);

        $newStorage->products()->attach($request->input('products'));

        return redirect()->route('storages.index');
    }

    public function destroy(Storage $storage)
    {
        $storage->delete();

        return redirect()->route('storages.index');
    }

}
