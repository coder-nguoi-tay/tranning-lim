<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table = 'package';
    protected $fillable = [
        'name',
        'price',
        'weight',
        'shipment_id',
        'user_id',
        'shop_id',
        'order_id',
    ];
    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }
}
