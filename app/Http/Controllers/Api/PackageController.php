<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageCollection;
use App\Repository\Package\PackageRepositoryInterface;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    private $package;
    public function __construct(PackageRepositoryInterface $package)
    {
        $this->package = $package;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->package->getData();
        if ($data) {
            return new PackageCollection($data);
        }
        return response()->json([
            'status' => 404
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
        ];
        if ($this->package->store($data)) {
            return response()->json([
                'status' => 201
            ]);
        }
        return response()->json([
            'status' => 429
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->package->show($id);
        if ($data) {
            return new PackageCollection($data);
        }
        return response()->json([
            'status' => 404,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
        ];
        if ($this->package->update($id, $data)) {
            return response()->json([
                'status' => 200
            ]);
        }
        return response()->json([
            'status' => 404
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->package->delete($id)) {
            return response()->json([
                'status' => 204
            ]);
        }
        return response()->json([
            'status' => 404
        ]);
    }
}
