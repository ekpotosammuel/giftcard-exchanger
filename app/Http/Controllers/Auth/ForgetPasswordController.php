<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Notification;
use App\Models\User;


class ForgetPasswordController extends Controller
{
    public function forget(Request $request){
        $email = request()->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = rand(1000, 9999);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = User::where('email', $request->email)->first();
        Notification::send($user, new ResetPasswordNotification($token));

        return response()->json([
            'Message' => 'Reset Code Sent'
        ]);
    }
}
