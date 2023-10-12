<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(TransactionTypeSeeder::class);
        $this->call(UserProfileSeeder::class);
        // $this->call(TransactionSeeder::class);
        $this->call(CollectionModeSeeder::class);
        $this->call(RateSeeder::class);
        $this->call(StatusSeeder::class);

    }
}
