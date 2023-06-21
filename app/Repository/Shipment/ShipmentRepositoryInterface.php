<?php

namespace App\Repository\Shipment;


interface ShipmentRepositoryInterface
{
    public function getData();
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function delete($id);
}
