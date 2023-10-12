<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_profile = [
            [
                'user_id'       => 1,
                'country_id'    => 161,
                'currency_id'   => 3,
            ],
            [
                'user_id'       => 2,
                'country_id'    => 161,
                'currency_id'   => 3,
            ]
        ];

        foreach ($user_profile as $key => $value) {
            $user_id = $value['user_id'];
            $country_id = $value['country_id'];
            $currency_id = $value['currency_id'];
            $already_exist = UserProfile::where('user_id', $user_id)->first();
            if ($already_exist == null) {
                $user_profile = new UserProfile();
                $user_profile->user_id       = $user_id;
                $user_profile->country_id    = $country_id;
                $user_profile->currency_id   = $currency_id;
                $user_profile->save();
            }
        }
    }
}
