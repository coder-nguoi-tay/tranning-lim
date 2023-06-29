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
        'price',
        'status'
    ];

    public function package()
    {
        return $this->hasMany(Package::class);
    }
}
