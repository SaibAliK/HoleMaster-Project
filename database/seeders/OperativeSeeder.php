<?php

namespace Database\Seeders;

use App\Models\Operative;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $operative = User::create([
            'name' => 'operative', 
            'email' => 'operative@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at'=>Carbon::now(),
            'type'=>'operative'
        ]);

        Operative::create([
            'first_name'=>'operative',
            'surname'=>'operative',
            'user_id'=> $operative,
            'phone'=>'1231232',
            'address1'=>'address123',
            'address2'=>'address123',
            'town'=>'evan field',
            'city'=>'austria',
            'post_code'=>'543',

        ]);








    }
}
