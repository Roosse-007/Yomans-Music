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
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (!$token = auth('api')->attempt($credentials)) {
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah'
        ], 401);
    }

    return response()->json([
        'success' => true,
        'message' => 'Login berhasil',
        'token'   => $token,
        'type'    => 'bearer',
        'expires' => auth('api')->factory()->getTTL() * 60
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

    public function refresh()
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token tidak ditemukan'
                ], 401);
            }

            $newToken = JWTAuth::refresh($token);

            return response()->json([
                'success' => true,
                'message' => 'Token berhasil diperbarui',
                'token'   => $newToken,
                'type'    => 'bearer',
                'expires' => auth('api')->factory()->getTTL() * 60
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid atau sudah expired'
            ], 401);
        }
    }
}
