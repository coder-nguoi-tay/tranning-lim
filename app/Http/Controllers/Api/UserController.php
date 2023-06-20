<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->authorize('view', User::class);
            $user = $this->user->index();
            return new UserCollection($user);
        } catch (\Throwable $th) {
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ];
        try {
            $this->authorize('store', User::class);
            if ($this->user->store($data)) {
                return response()->json([
                    'status' => 201,
                ]);
            }
            return response()->json([
                'status' => 404
            ]);
        } catch (\Throwable $th) {
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->user->show($id);
        if ($user) {
            return new UserCollection($user);
        }
        return response()->json([
            'status' => 404
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ];
        try {
            $this->authorizeForUser('update', User::class);
            if ($this->user->update($data, $id)) {
                return response()->json([
                    'status' => 200
                ]);
            }
            return response()->json([
                'status' => 403
            ]);
        } catch (\Throwable $th) {
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->authorizeForUser('delete', User::class);
            if ($this->user->delete($id)) {
                return response()->json([
                    'status' => 200
                ]);
            };
            return response()->json([
                'status' => 404
            ]);
        } catch (\Throwable $th) {
        }
    }
}
