<?php

namespace Database\Seeders;

use App\Models\CollectionMode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = [
            'Physical',
            'E-Code'
        ];

        foreach ($collection as $key => $value) {
            $already_exist = CollectionMode::where('name', $value)->first();
            if($already_exist == null){
                $collection = new CollectionMode();
                $collection->name = $value;
                $collection->save();
            }
        }
    }
}
