<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "status" => "success",
            "access_token" => $token,
            "token_type" => 'Bearer',
            "user" => $user
        ]);
    }

    public function logout(Request $request)
    {

        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });
        return response()->json('Successfully logged out');

    }
}
