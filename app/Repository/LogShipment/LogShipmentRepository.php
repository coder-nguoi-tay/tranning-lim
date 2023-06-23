<?php

namespace App\Repository\LogShipment;

use App\Models\LogShipment;
use App\Repository\BaseRepository;

class  LogShipmentRepository extends BaseRepository
{
    protected $model;
    public function __construct(LogShipment $logShip)
    {
        $this->model = $logShip;
    }
}
