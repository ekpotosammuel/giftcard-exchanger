<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function SoftDeletes()
    {
        $user = auth('sanctum')->user();
        $currency = User::findorFail($user->id);
        if($currency->delete()){

            return 'deleted successfully';
        }
    }

    public function changePassword(Request $request){

        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return response()->json([
                'status' =>"Old Password Doesn't match!"
            ]);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return response()->json([
            'status' =>"Password changed successfully!"
        ]);
    }
}
