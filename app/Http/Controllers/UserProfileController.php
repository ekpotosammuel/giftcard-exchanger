<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userProfile = UserProfile::get();
        return response()->json([
            'Message' => 'All Profile',
            'Status'  => $userProfile
        ],200);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile, $id)
    {
        $user = auth('sanctum')->user();
        $userProfile = UserProfile::findorFail($user->id);
        return response()->json([
            'Message' => 'Profile Details',
            'Status'  => $userProfile
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function allProfile(UserProfile $userProfile, $id)
    {
        $userProfile = UserProfile::findorFail($id);
        return response()->json([
            'Message' => 'Profile Details',
            'Status'  => $userProfile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserProfileRequest  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfileRequest $request, UserProfile $userProfile)
    {
        $user = auth('sanctum')->user();
        $this->validate($request,[
            'avatar'        => 'nullable|mimes:png,jpg,jpeg,gif|max:2048',
            'phone'         => 'required',
        ]);

        $profile = UserProfile::where('user_id', $user->id)->first();
        $userProfile = UserProfile::findorFail($profile->id);
        if($request->file('avatar')){
            $avatar = $request->file('avatar')->store('public/buckets');
            $avatar_url = str_replace("public", "storage", $avatar);
            $image = env("APP_URL")."/".$avatar_url;
            $userProfile->avatar = $image;
        }
        $userProfile->phone = $request->input('phone');
        $userProfile->update();
        return response()->json([
            'Message' => 'Profile Sucessfully Updated',
            'Status'  => $userProfile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
