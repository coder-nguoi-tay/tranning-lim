<?php

namespace App\Repository\Shipment;

use App\Models\Shipment;

class ShipmentRepository implements ShipmentRepositoryInterface
{
    private $shipments;
    public function __construct(Shipment $shipment)
    {
        $this->shipments = $shipment;
    }
    public function getData()
    {
        return $this->shipments->get();
    }
    public function store($request)
    {
        $shipment = new $this->shipments($request);
        if ($shipment->save()) {
            return true;
        }
        return false;
    }
    public function show($id)
    {
        return $this->shipments->find($id);
    }
    public function update($request, $id)
    {
        $shipment = $this->show($id)->update($request);
        if ($shipment) {
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        if ($this->shipments->destroy($id)) {
            return true;
        }
        return false;
    }
}
