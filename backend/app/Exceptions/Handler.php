<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * HANDLE USER BELUM LOGIN / TANPA TOKEN
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'success' => false,
            'message' => 'Token tidak ditemukan atau belum login'
        ], 401);
    }

    /**
     * HANDLE SEMUA ERROR API (JWT, VALIDASI, DLL)
     */
    public function render($request, Throwable $e)
    {
        // =========================
        // TOKEN KADALUARSA
        // =========================
        if ($e instanceof TokenExpiredException) {
            return response()->json([
                'success' => false,
                'message' => 'Token sudah kadaluarsa'
            ], 401);
        }

        // =========================
        // TOKEN TIDAK VALID
        // =========================
        if ($e instanceof TokenInvalidException) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid'
            ], 401);
        }

        // =========================
        // TOKEN TIDAK ADA / RUSAK
        // =========================
        if ($e instanceof JWTException) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak ditemukan'
            ], 401);
        }

        // =========================
        // VALIDASI GAGAL
        // =========================
        if ($e instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors()
            ], 422);
        }

        // =========================
        // HTTP EXCEPTION (403, 404, DLL)
        // =========================
        if ($e instanceof HttpException) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Terjadi kesalahan'
            ], $e->getStatusCode());
        }

        // =========================
        // ERROR LAINNYA (500)
        // =========================
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan pada server',
            'error'   => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}
