<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $status = [
        //     [
        //         'name' => 'Pending'
        //     ],
        //     [
        //         'name' =>'decline'
        //     ],
        //     [
        //         'name' =>'Accept'
        //     ]
        // ];

        // foreach ($status as $key => $value['name']) {
        //     $already_exist = Status::where('name', $value)->first();
        //     if($already_exist == null){
        //         $status = new Status();
        //         $status->name = $value['name'];
        //         $status->save();
        //     }
        // }

        $status = [
            // 'Pending',
            // 'Active',
            // 'Decline'
            [
                'name' => 'Pending'
            ],
            [
                'name' =>'Decline'
            ],
            [
                'name' =>'Successful'
            ]
        ];

        foreach ($status as $key => $value) {
            # code...
            $already_exist = Status::where('name', $value)->first();
            if ($already_exist == null) {
                $status = new Status();
                $status->name = $value['name'];
                $status->save();
            }
        }
    }
}
