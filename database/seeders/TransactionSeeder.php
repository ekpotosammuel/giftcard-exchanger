<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) {

            $transaction_type_id    = rand(1,2);
            $user_id                = rand(1, 2);
            $reference              = "ZAN-".strtoupper(Str::random(5));
            $amount                 = rand(100, 99999);

            $transaction                        = new Transaction();
            $transaction->transaction_type_id   = $transaction_type_id;
            $transaction->user_id               = $user_id;
            $transaction->reference             = $reference;
            $transaction->amount                = $amount;
            $transaction->save();

        }
    }
}
