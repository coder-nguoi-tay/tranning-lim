<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
