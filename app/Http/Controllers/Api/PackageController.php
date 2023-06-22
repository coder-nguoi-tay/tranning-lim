<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageCollection;
use App\Repository\Package\PackageRepository;

/**
 * @group package
 *
 * APIs for managing users
 */
class PackageController extends Controller
{
    private $package;
    public function __construct(PackageRepository $package)
    {
        $this->package = $package;
    }
    /**
     * get thông tin pack.
     *
     * @response 200 {
     *   "id": "1111",
     *   "name": "111",
     *   "price": 11,
     *   "weight": 11,
     * }
     * @response 404
     */
    public function index()
    {
        try {
            $data = $this->package->getData();
            if ($data) {
                return new PackageCollection($data);
            }
            return response()->json([
                'status' => 404
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }

    /**
     * thêm thông tin package.
     * /**
     * @bodyParam name id required Example: 11
     * @bodyParam price id required Example: 11
     * @bodyParam weight id required Example: 11
     *
     * @response 201 {
     *   "status": "201",
     * }
     * @response 404
     */
    public function store(PackageRequest $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
        ];
        try {
            if ($this->package->store($data)) {
                return response()->json([
                    'status' => 201
                ]);
            }
            return response()->json([
                'status' => 404
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }

    /**
     * show thông tin package.
     *@urlParam id required Example: 2
     *
     * @response 200 {
     *   "shipment_id": "1111",
     *   "shiper_id": "111",
     *   "status": 11,
     *   "post_offices_id": 11,
     * }
     * @response 404
     */
    public function show(string $id)
    {
        try {
            $data = $this->package->show($id);
            if ($data) {
                return new PackageCollection($data);
            }
            return response()->json([
                'status' => 404,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }

    /**
     * cập nhật thông tin package.
     * /**
     * @bodyParam name id required Example: 11
     * @bodyParam price id required Example: 11
     * @bodyParam weight id required Example: 11
     *
     * @response 200 {
     *   "status": "201",
     * }
     * @response 404
     */
    public function update(PackageRequest $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
        ];
        try {
            if ($this->package->update($id, $data)) {
                return response()->json([
                    'status' => 200
                ]);
            }
            return response()->json([
                'status' => 404
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }

    /**
     * xóa thông tin package.
     *@urlParam id required Example: 2
     *
     * @response 204 {
     *   "status": "200",
     * }
     * @response 404
     */
    public function destroy(string $id)
    {
        try {
            if ($this->package->delete($id)) {
                return response()->json([
                    'status' => 204
                ]);
            }
            return response()->json([
                'status' => 404
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }
}
