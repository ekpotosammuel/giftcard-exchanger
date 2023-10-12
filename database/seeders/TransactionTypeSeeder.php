<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionType;
class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction_type = [
            'debit',
            'credit'
        ];

        foreach ($transaction_type as $key => $value) {
            # code...
            $already_exist = TransactionType::where("name", $value)->first();
            if ($already_exist == null) {
                $transaction_type = new TransactionType();
                $transaction_type->name = $value;
                $transaction_type->save();
            }
        }
    }
}
