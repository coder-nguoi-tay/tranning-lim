<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShipmentRequest;
use App\Http\Resources\ShipmentCollection;
use App\Repository\Shipment\ShipmentRepositoryInterface;
use App\service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $shipment;
    private $userService;
    public function __construct(ShipmentRepositoryInterface $shipment, UserService $userService)
    {
        $this->shipment = $shipment;
        $this->userService = $userService;
    }
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
     * Store a newly created resource in storage.
     */
    public function store(ShipmentRequest $request)
    {
        try {
            $data = [
                'code_bill' => $this->userService->generateTrackingNumber(),
                'code_order' => $request->code_order,
                'shop_id' => $request->shop_id,
                'price' => $request->price,
                'status' => $request->status,
                'user_id' => Auth::guard('api')->user()->id,
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
     * Display the specified resource.
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
     * Update the specified resource in storage.
     */
    public function update(ShipmentRequest $request, string $id)
    {
        $data = [
            'code_order' => $request->code_order,
            'shop_id' => $request->shop_id,
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
     * Remove the specified resource from storage.
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
