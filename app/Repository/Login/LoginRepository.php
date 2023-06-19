<?php

namespace App\Repository\Login;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRepository implements LoginInterface
{
    public function login($request)
    {
        $requester = $request->withParsedBody([
            'grant_type' => 'password',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'username' => $request->getParsedBody()['email'],
            'password' => $request->getParsedBody()['password'],
            'scope' => '',
        ]);

        return app()->make(\Laravel\Passport\Http\Controllers\AccessTokenController::class)->issueToken($requester);
    }
    public function register($request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user->save()) {
            return true;
        }
        return false;
    }
}
