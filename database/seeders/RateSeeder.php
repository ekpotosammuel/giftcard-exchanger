<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rate = [
            [
                'name' => '£',
                'amount' => 500,
            ],
            [
                'name' => '$',
                'amount' => 400,
            ],

        ];

        foreach ($rate as $key => $value) {
            $already_exist = Rate::where('name', $value)->first();
            if($already_exist == null){
                $currency = new Rate();
                $currency->name = $value['name'];
                $currency->amount = $value['amount'];
                $currency->save();
            }
        }
    }
}
