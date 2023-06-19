<?php

namespace App\Repository\User;

use App\Repository\User\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function index()
    {
        $user = User::all();
        return $user;
    }
    public function create()
    {
    }
    public function store($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if (!$user->save()) {
            return false;
        }
        return true;
    }
    public function update($request, $id)
    {
        $user = $this->show($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if (!$user->save()) {
            return false;
        }
        return true;
    }
    public function delete($id)
    {
        if (User::destroy($id)) {
            return true;
        }
        return false;
    }
    public function show($id)
    {
        $user = User::query()->find($id);
        return $user;
    }
}
