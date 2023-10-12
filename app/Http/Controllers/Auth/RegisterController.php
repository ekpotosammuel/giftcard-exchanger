<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserRole;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name'              =>  'required',
            'email'             =>  'required|email|unique:users',
            'password'          =>  'required',
        ]);
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
        ]);

        $user_role = UserRole::create([
            'user_id'      => $user->id,
            'role_id'      => 2,
        ]);
        $user_profile = UserProfile::create([
            'user_id'       => $user->id,
            'currency_id'   => 3,
            'country_id'    => 161

        ]);


        return response()->json([
            'message' => 'registration successful',
            'data'    => $user
        ],201);
    }
}
