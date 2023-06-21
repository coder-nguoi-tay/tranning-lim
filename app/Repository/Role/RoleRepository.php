<?php

namespace App\Repository\Role;

use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class RoleRepository implements RoleRepositoryInterface
{
    private $userRole;
    public function __construct(UserRole $userRole)
    {
        $this->userRole = $userRole;
    }
    public function RoleId()
    {
        $user = $this->userRole->query()->where('user_id', Auth::guard('api')->user()->id)->pluck('role')->toArray();
        return $user;
    }
}
