<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = [
            '£',
            '$',
            '₦'
        ];

        foreach ($currency as $key => $value) {
            $already_exist = Currency::where('name', $value)->first();
            if($already_exist == null){
                $currency = new Currency();
                $currency->name = $value;
                $currency->save();
            }
        }
    }
}
