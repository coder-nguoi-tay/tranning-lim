<?php

namespace App\Repository\User;

use App\Repository\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $user = $this->user->all();
        return $user;
    }
    public function create()
    {
    }
    public function store($request)
    {
        $user = new $this->user($request);
        if (!$user->save()) {
            return false;
        }
        return true;
    }
    public function update($request, $id)
    {
        $user = $this->show($id)->update($request);
        if (!$user) {
            return false;
        }
        return true;
    }
    public function delete($id)
    {
        if ($this->user->destroy($id)) {
            return true;
        }
        return false;
    }
    public function show($id)
    {
        $user = $this->user->query()->find($id);
        return $user;
    }
}
