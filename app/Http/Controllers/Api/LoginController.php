<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repository\Login\LoginRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $login;
    public function __construct(LoginRepositoryInterface $login)
    {
        $this->login = $login;
    }
    public function register(LoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ];
        if ($this->login->register($data)) {
            return response()->json(['status' => 201]);
        }
        return response()->json(['status' => 429]);
    }
    public function login(ServerRequestInterface $request)
    {
        $validator = FacadesValidator::make($request->getParsedBody(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }
        $data = $this->login->login($request);
        if ($data) {
            return response()->json($data);
        }
        return response()->json([
            'status' => 'failed',
        ]);
    }
    public function info()
    {
        $user = Auth::guard('api')->user();
        return response()->json($user);
    }
}
