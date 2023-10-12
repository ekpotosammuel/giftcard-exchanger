<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{


    public function reset(Request $request){
        $email = request()->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return response()->json([
                "Message" => "Invalid token provided"
            ], 400);
        }

        $user = User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return response()->json([
            'Message' => 'Password Rest Successful'
        ]);
    }
}
