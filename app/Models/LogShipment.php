<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogShipment extends Model
{
    use HasFactory;
    protected $table = 'log_shipment';
    protected $fillable = [
        'shipment_id',
        'status',
        'post_offices_id',
        'shiper_id',
    ];
    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'id', 'shipment_id');
    }
}
