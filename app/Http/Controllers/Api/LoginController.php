<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repository\Login\LoginInterface;
use Illuminate\Http\Request;
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
    public function __construct(LoginInterface $login)
    {
        $this->login = $login;
    }
    public function register(LoginRequest $request)
    {
        if ($this->login->login($request)) {
            return response()->json(['status' => 201]);
        }
        return response()->json(['status' => 404]);
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
