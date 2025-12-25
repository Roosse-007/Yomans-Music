<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        Log::info('User registered', ['user_id' => $user->id]);

        return response()->json([
            'success' => true,
            'message' => 'Register success',
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        Log::info('User login', [
            'user_id' => Auth::id(),
            'ip' => $request->ip()
        ]);

        return response()->json([
            'success' => true,
            'token' => $token,
            'token_type' => 'bearer'
        ]);
    }

    public function me()
{
    return response()->json([
        'success' => true,
        'data' => Auth::user()
    ]);
}


    public function logout()
    {
        Auth::logout();

        Log::info('User logout', ['user_id' => Auth::id()]);

        return response()->json([
            'success' => true,
            'message' => 'Logout success'
        ]);
    }
}
