<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|min:3|max:255',
            'password' => 'required'
        ]);


        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Учетные данные неверны.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Авторизация прошла успешно'
        ], 200);
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $this->guard()->logout();
        return response()->json([
            'status_code' => '200',
            'message' => 'logged out successfully'
        ]);

    }
    public function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }

}
