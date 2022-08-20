<?php


namespace App\Http\Services;


use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Http\Services\Dtos\UserDto;
use App\Jobs\UserCreate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    private function checkUserByEmail(string $email)
    {
        return User::where('email', $email)->first();

    }

    public function register(UserDto $userDto): JsonResponse
    {

        $user = $this->checkUserByEmail($userDto->email);
        if ($user) return response()->json([
            'message' => 'User Already Exist',
        ], 401);
        dispatch(new UserCreate($userDto));

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
        ]);
    }

    public function getuserInformation($user): JsonResponse
    {

        $user = new UserResource($user);
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }

    public function updateUserInformation($request): JsonResponse
    {
        User::where('id', $request->id)->update(array('role' => $request->role));
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function removeUserRole($id): JsonResponse
    {
        User::where('id', $id)->update(array('role' => null));
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function getUsers()
    {
        return response()->json([
            'status' => 'success',
            'users' => UserResource::collection(User::all()),
        ]);
    }

    public function storeRole($role)
    {
        Role::create([
            'name' => $role,
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function getRole()
    {
        return response()->json([
            'status' => 'success',
            'roles' => RoleResource::collection(Role::all()),
        ]);
    }
}
