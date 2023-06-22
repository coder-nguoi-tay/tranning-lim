<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Repository\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group User
 *
 * APIs for managing users
 */
class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    /**
     * get thông tin user.
     *
     * @response 200 {
     *   "id": "1111",
     *   "code_bill": "111",
     *   "code_order": 11,
     *   "price": 11,
     *   "status": 11,
     *   "user_id": 11,
     * }
     * @response 404
     */

    public function index()
    {
        try {
            $this->authorize('view', User::class);
            $user = $this->user->getData();
            return new UserCollection($user);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }

    /**
     * api thêm user.
     * 
     * 
     * @bodyParam email id required Example: 11
     * @bodyParam name id required Example: 11
     * @bodyParam password id required Example: 11
     *
     * @response 201 {
     *   "status": "201",
     * }
     * @response 404
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
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }
    /**
     * show thông tin logshipment.
     *@urlParam id required Example: 2
     *
     * @response 200 {
     *   "name": "1111",
     *   "email": "111",
     * }
     * @response 404
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
     * api cập nhật user.
     * 
     * @bodyParam email id required Example: 11
     * @bodyParam name id required Example: 11
     * @bodyParam password id required Example: 11
     *
     * @response 200 {
     *   "status": "200",
     * }
     * @response 404
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
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }

    /**
     * xóa thông tin user.
     *@urlParam id required Example: 2
     *
     * @response 204 {
     *   "status": "204",
     * }
     * @response 404
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
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }
}
