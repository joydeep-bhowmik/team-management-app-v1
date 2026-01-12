<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = $request->user();

            //deleting old token
            $user->tokens()->delete();

            $token = $user->createToken('login-token')?->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json([
            'errors' => [
                'email' => ['The provided credentials do not match our records.'],
            ],
        ], 422);
    }
}
