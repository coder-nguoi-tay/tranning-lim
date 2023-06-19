<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Repository\User\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->authorizeForUser('view', User::class);
            $user = $this->user->index();
            return new UserCollection($user);
        } catch (\Throwable $th) {
            return response()->json(['message' => 429]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->authorizeForUser('create', User::class);
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 429]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $this->authorizeForUser('store', User::class);
            if ($this->user->store($request)) {
                return response()->json([
                    'status' => 201,
                ]);
            }
            return response()->json([
                'status' => 404
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 429]);
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
            'status' => 422
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            $this->authorizeForUser('update', User::class);
            if ($this->user->update($request, $id)) {
                return response()->json([
                    'status' => 200
                ]);
            }
            return response()->json([
                'status' => 403
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
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
                    'status' => 204
                ]);
            };
            return response()->json([
                'status' => 404
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 429]);
        }
    }
}
