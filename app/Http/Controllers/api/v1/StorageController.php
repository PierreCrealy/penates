<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StorageResource;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StorageController extends Controller
{
    public function index()
    {
        return StorageResource::collection(Storage::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
        ];

        return new StorageResource(Storage::create($data));
    }

    public function show(Storage $storage)
    {
        return new StorageResource($storage);
    }

    public function update(Request $request, Storage $storage)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
        ];

        $storage->update($data);

        return new StorageResource($storage);
    }

    public function destroy(Storage $storage)
    {
        $storage->delete();

        return response()->json();
    }
}
