<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShipmentRequest;
use App\Http\Resources\ShipmentCollection;
use App\Repository\Shipment\ShipmentRepository;
use App\service\UserService;
use Illuminate\Support\Facades\Auth;

/**
 * @group shipment
 *
 * APIs for managing users
 */
class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $shipment;
    private $userService;
    public function __construct(ShipmentRepository $shipment, UserService $userService)
    {
        $this->shipment = $shipment;
        $this->userService = $userService;
    }
    /**
     * get thông tin shipment.
     *
     * @response 200 {
     *   "id": "1111",
     *   "code_bill": "111",
     *   "code_order": 11,
     *   "price": 11,
     *   "status": 11,
     *   "user_id": 11,
     * }
     * @response 404
     */
    public function index()
    {
        $data = $this->shipment->getData();
        if ($data) {
            return new ShipmentCollection($data);
        }
        return response()->json([
            'error' => 404
        ]);
    }

    /**
     * thêm thông tin shipment.
     * /**
     * @bodyParam code_order id required Example: 11
     * @bodyParam price id required Example: 11
     * @bodyParam status id required Example: 11
     * @bodyParam user_id id required Example: 11
     *
     * @response 201 {
     *   "status": "201",
     * }
     * @response 404
     */
    public function store(ShipmentRequest $request)
    {
        try {
            $data = [
                'code_bill' => $this->userService->generateTrackingNumber(),
                'code_order' => $request->code_order,
                'shop_id' => Auth::guard('api')->user()->id,
                'price' => $request->price,
                'status' => $request->status,
                'user_id' => $request->user,
            ];
            if ($this->shipment->store($data)) {
                return response()->json([
                    'status' => 201
                ]);
            }
            return response()->json([
                'error' => 404
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * show thông tin shipment.
     *@urlParam id required Example: 2
     *
     * @response 200 {
     *   "id": "1111",
     *   "code_bill": "111",
     *   "code_order": 11,
     *   "shop_id": 11,
     *   "price": 11,
     *   "user_id": 11,
     * }
     * @response 404
     */
    public function show(string $id)
    {
        $data = $this->shipment->show($id);
        if ($data) {
            return new ShipmentCollection($data);
        }
        return response()->json([
            'status' => 404
        ]);
    }


    /**
     * cập nhật thông tin shipment.
     * /**
     * @bodyParam code_order id required Example: 11
     * @bodyParam price id required Example: 11
     * @bodyParam status id required Example: 11
     * @bodyParam user_id id required Example: 11
     *
     * @response 200 {
     *   "status": "200",
     * }
     * @response 404
     */
    public function update(ShipmentRequest $request, string $id)
    {
        $data = [
            'code_order' => $request->code_order,
            'user_id' => $request->user_id,
            'price' => $request->price,
            'status' => $request->status,
        ];
        try {
            if ($this->shipment->update($data, $id)) {
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
     * xóa thông tin shipment.
     *@urlParam id required Example: 2
     *
     * @response 204 {
     *   "status": "204",
     * }
     * @response 404
     */
    public function destroy(string $id)
    {
        try {
            if ($this->shipment->delete($id)) {
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
