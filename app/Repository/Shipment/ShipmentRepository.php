<?php

namespace App\Repository\Shipment;


use App\Models\Shipment;
use App\Repository\BaseRepository;

class ShipmentRepository extends BaseRepository
{
    protected $model;
    public function __construct(Shipment $ship)
    {
        $this->model = $ship;
    }
}
