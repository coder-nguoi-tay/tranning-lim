<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $table = 'shipment';
    protected $fillable = [
        'code_bill',
        'code_order',
        'shop_id',
        'user_id',
        'price',
        'status'
    ];
}
