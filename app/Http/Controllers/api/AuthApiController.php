<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    public function loginApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Jika user adalah driver, include data driver
        $driver = null;
        if ($user->hasRole('driver')) {
            $driver = $user->driver;
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => $user->load('roles'),
            'driver'  => $driver,
        ]);
    }

    public function logoutApi(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'User not found or already logged out.',
                ], 401);
            }

            $user->currentAccessToken()->delete();

            return response()->json([
                'status'  => 'success',
                'message' => 'Logout successful',
            ]);
        } catch (\Exception) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }
}
