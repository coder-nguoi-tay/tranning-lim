<?php

namespace App\Listeners\Shipment;

use App\Events\Shipment\LogShipmentEvent;
use App\Repository\LogShipment\LogShipmentRepository;
use Carbon\Carbon;

class LogShipmentListener
{
    /**
     * Create the event listener.
     */
    private $LogShipment;
    public function __construct(LogShipmentRepository $LogShipment)
    {
        $this->LogShipment = $LogShipment;
    }

    /**
     * Handle the event.
     */
    public function handle(LogShipmentEvent $event): void
    {
        $dataLocal = collect($event->dataLocal);
        $dataShipment = collect($event->dataUpdate);
        $differentElements = $dataShipment->diffAssoc($dataLocal);
        if (count($differentElements) > 0) {
            $differentElements['updated_at'] = Carbon::parse($differentElements['updated_at'])->format('Y/m/d H:i:s');
            $data = [
                'shipment_id' => $dataLocal['id'],
                'text' =>
                "update shipment status " . $dataLocal['status'] . ' -> ' . $differentElements['status'] . " update time " . $differentElements['updated_at']
            ];
            $this->LogShipment->store($data);
        }
    }
}
