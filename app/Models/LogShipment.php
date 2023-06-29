<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogShipment extends Model
{
    use HasFactory;
    protected $table = 'log_shipment';
    protected $fillable = [
        'id',
        'shipment_id',
        'text',
    ];
    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'id', 'shipment_id');
    }
}
