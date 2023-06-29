<?php

namespace App\Repository\User;

use App\Models\User;
use App\Models\UserRole;
use App\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $model;
    protected $role;
    public function __construct(User $user, UserRole $role)
    {
        $this->model = $user;
        $this->role = $role;
    }
    public function delete($id)
    {
        $data = $this->model->with(['roles'])->find($id);
        foreach ($data->roles as $item) {
            $item->delete();
        }
        return parent::delete($id);
    }
}
