<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Repository\Role\RoleRepositoryInterface;
use App\service\UserService;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    private $role;
    private $user;
    public function __construct(UserService $user, RoleRepositoryInterface $role)
    {
        $this->role = $role;
        $this->user = $user;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        if ($this->user->isAdmin($this->role->RoleId(), UserRoleEnum::Role())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function store(): bool
    {
        if ($this->user->isAdmin($this->role->RoleId(), UserRoleEnum::Role())) {
            return true;
        }
        return false;
    }
    public function create(): bool
    {
        if ($this->user->isAdmin($this->role->RoleId(), UserRoleEnum::Role())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        if ($this->user->isAdmin($this->role->RoleId(), UserRoleEnum::Role())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        if ($this->user->isAdmin($this->role->RoleId(), UserRoleEnum::Role())) {
            return true;
        }
        return false;
    }
}
