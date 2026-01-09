<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // ✅ LOG REGISTER
        activity_log(
            'REGISTER',
            'AUTH',
            'User mendaftar akun baru: ' . $user->email
        );

        return response()->json([
            'success' => true,
            'message' => 'Register success',
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // ✅ LOG LOGIN
        activity_log(
            'LOGIN',
            'AUTH',
            'User berhasil login: ' . auth('api')->user()->email
        );

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer'
        ]);
    }

    public function me()
    {
        return response()->json([
            'success' => true,
            'data' => auth('api')->user()
        ]);
    }

    public function logout()
    {
        // ✅ LOG LOGOUT
        activity_log(
            'LOGOUT',
            'AUTH',
            'User logout'
        );

        auth('api')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout success'
        ]);
    }
}
