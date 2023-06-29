<?php

namespace App\Repository\Shipment;

use App\Events\Shipment\LogShipmentEvent;
use App\Models\Shipment;
use App\Repository\BaseRepository;

class ShipmentRepository extends BaseRepository
{
    protected $model;
    public function __construct(Shipment $ship)
    {
        $this->model = $ship;
    }
    public function update($data, $id)
    {
        $dataLocal = $this->show($id);
        $dataUpdate = parent::update($data, $id);
        event(new LogShipmentEvent($dataLocal, $dataUpdate));
        return $dataUpdate;
    }
}
