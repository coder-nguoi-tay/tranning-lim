<?php

namespace App\Policies;

use App\Models\User;
use App\Repository\Role\RoleInterface;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    private $role;
    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        if ($this->role->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function store(): bool
    {
        if ($this->role->isAdmin()) {
            return true;
        }
        return false;
    }
    public function create(): bool
    {
        if ($this->role->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        if ($this->role->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        if ($this->role->isAdmin()) {
            return true;
        }
        return false;
    }
}
