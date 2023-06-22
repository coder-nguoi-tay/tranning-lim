<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogShipmentRequest;
use App\Http\Resources\LogShipCollection;
use App\Repository\LogShipment\LogShipmentRepository;

/**
 * @group Log Ship
 *
 * APIs for managing users
 */
class LogShipmentController extends Controller
{
    private $logShip;
    public function __construct(LogShipmentRepository $logShip)
    {
        $this->logShip = $logShip;
    }
    /**
     * get LogShipment 
     *
     *
     * @response 200 {
     *   "shipment_id": "1111",
     *   "shiper_id": "111",
     *   "status": 11,
     *   "post_offices_id": 11,
     * }
     * @response 404
     */
    public function index()
    {
        try {
            if ($this->logShip->getData()) {
                return new LogShipCollection($this->logShip->getData());
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
     * api thêm logshipment.
     * 
     * 
     * 
     * @bodyParam shipment_id id required Example: 11
     * @bodyParam status id required Example: 11
     * @bodyParam post_offices_id id required Example: 11
     * @bodyParam shiper_id id required Example: 111
     *
     * @response 201 {
     *   "shipment_id": "1111",
     *   "shiper_id": "111",
     *   "status": 11,
     *   "post_offices_id": 11,
     * }
     * @response 404
     */

    public function store(LogShipmentRequest $request)
    {
        $data = [
            'shipment_id' => $request->shipment_id,
            'status' => $request->status,
            'post_offices_id' => $request->post_offices_id,
            'shiper_id' => $request->shiper_id,
        ];
        try {
            if ($this->logShip->store($data)) {
                return response()->json([
                    'status' => 201,
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
     * show thông tin logshipment.
     *@urlParam id required Example: 2
     *
     * @response {
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
            if ($this->logShip->show($id)) {
                return new LogShipCollection($this->logShip->show($id)->first());
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
     * update thông tin logshipment.
     * @bodyParam shipment_id id required Example: 11
     * @bodyParam status id required Example: 11
     * @bodyParam post_offices_id id required Example: 11
     * @bodyParam shiper_id id required Example: 111
     *
     * @response 200 {
     *   "shipment_id": "1111",
     *   "shiper_id": "111",
     *   "status": 11,
     *   "post_offices_id": 11,
     * }
     * @response 404
     */
    public function update(LogShipmentRequest $request, string $id)
    {
        $data = [
            'shipment_id' => $request->shipment_id,
            'status' => $request->status,
            'post_offices_id' => $request->post_offices_id,
            'shiper_id' => $request->shiper_id,
        ];
        try {
            if ($this->logShip->update($data, $id)) {
                return response()->json([
                    'success' => 200,
                ]);
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
     * xóa thông tin log shipment.
     * show thông tin logshipment.
     * @urlParam id required Example: 2
     *
     * @response 204 {
     *   "status": "204",,
     * }
     * @response 404
     */
    public function destroy(string $id)
    {
        try {
            if ($this->logShip->delete($id)) {
                return response()->json([
                    'success' => 204,
                ]);
            }
            return response()->json([
                'success' => 404,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }
}
