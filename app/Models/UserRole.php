<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'user_role';
    protected $fillable = [
        'user_id',
        'role',
    ];

    protected $casts = [
        'role' => RoleEnum::class
    ];
}
