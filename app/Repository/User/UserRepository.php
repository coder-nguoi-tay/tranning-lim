<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
