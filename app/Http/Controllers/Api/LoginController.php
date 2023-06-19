<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        return response()->json([
            'status' => 'success',
        ]);
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

        $requester = $request->withParsedBody([
            'grant_type' => 'password',
            'client_id' => '996c3a6b-0ea6-4790-be0e-0e6650bf84b9',
            'client_secret' => 'RlgY7WxkYdr5aN1vJ9k6nGCUEsTfSt67p0oHNToy',
            'username' => $request->getParsedBody()['email'],
            'password' => $request->getParsedBody()['password'],
            'scope' => '',
        ]);

        return app()->make(\Laravel\Passport\Http\Controllers\AccessTokenController::class)->issueToken($requester);
    }
    public function info()
    {
        $user = Auth::guard('api')->user();
        return response()->json($user);
    }
}
