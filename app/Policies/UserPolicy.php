<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Repository\Role\RoleRepositoryInterface;
use App\service\UserService;

class UserPolicy
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
        if ($this->user->isAdmin($this->role->RoleId(), config('app.user.view'))) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function store(): bool
    {
        if ($this->user->isAdmin($this->role->RoleId(), config('app.user.store'))) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        if ($this->user->isAdmin($this->role->RoleId(), config('app.user.update'))) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        if ($this->user->isAdmin($this->role->RoleId(), config('app.user.delete'))) {
            return true;
        }
        return false;
    }
}
