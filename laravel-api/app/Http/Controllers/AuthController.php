<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Http\Services\Dtos\UserDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('auth:api', ['except' => ['login', 'register', 'updateUserInformation']]);
    }

    public function login(Request $request)
    {
        $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

    }

    public function register(Request $request)
    {

        $validateUser = Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required',
                'password' => 'required|string|min:6',
            ]);
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
        $user = new UserDto([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return $this->authService->register($user);


    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function userInformation()
    {
        return $this->authService->getuserInformation(Auth::user());

    }

    public function updateUserInformation(Request $request)
    {
        $validateUser = Validator::make($request->all(),
            [
                'role' => 'required',
                'id' => 'required'
            ]);
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
        return $this->authService->updateUserInformation($request);
    }

    public function removeUserRole(Request $request)
    {
        return $this->authService->removeUserRole($request->id);
    }

    public function getUsers()
    {
        return $this->authService->getUsers();
    }

    public function storeRole(Request $request)
    {
        return $this->authService->storeRole($request->role);
    }

    public function getRole()
    {
        return $this->authService->getRole();
    }
}
