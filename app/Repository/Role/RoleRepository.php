<?php

namespace App\Repository\Role;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class RoleRepository implements RoleInterface
{
    public function RoleId($id)
    {
        $user = UserRole::query()->where('user_id', $id)->pluck('role')->first();
        return $user;
    }
    public function isAdmin()
    {
        return $this->RoleId(Auth::guard('api')->user()->id) === User::ADMIN;
    }
}
