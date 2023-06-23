<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repository\Login\LoginRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @group login
 *
 * APIs for managing users
 */
class LoginController extends Controller
{
    private $login;
    public function __construct(LoginRepository $login)
    {
        $this->login = $login;
    }
    /**
     * register User
     *
     * @bodyParam name string required Example: duc.
     * @bodyParam email string required Example: 5@gmail.com.
     * @bodyParam password string required Example: 12345.
     *
     * @response 201 {
     *   "name": "duc",
     *   "email": "5@gmail.com",
     * }
     * @response 404
     */
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
    /**
     * Login User
     *
     * @bodyParam email string required Example: 1@gmail.com
     * @bodyParam password string required Example: 12345
     *
     * @response 200 {
     *   "access_token": "xxxxxxxxxxxxxxxxxxxxxxxxxxxx",
     *   "token_type": "bearer",
     *   "expires_in": 3600
     * }
     * @response 404
     */
    public function login(ServerRequestInterface $request)
    {
        return 1;
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
            return $data;
            return response()->json($data);
        }
        return response()->json([
            'status' => 'failed',
        ]);
    }
    /**
     * show info User
     *
     * @urlParam id required Example: 2
     *
     * @response 200 {
     *   "name": "duc",
     *   "email": "5@gmail.com",
     * }
     */
    public function info()
    {
        $user = Auth::guard('api')->user();
        return response()->json($user);
    }
}
