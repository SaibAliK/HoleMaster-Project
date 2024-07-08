<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => Carbon::now(),
            'type' => 'super_admin'
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => Carbon::now(),
            'type' => 'admin'
        ]);

        Permission::create([
            'name' => 'Manage Clients',
            'controller' => 'ClientController'
        ]);
        Permission::create([
            'name' => 'Manage Operatives',
            'controller' => 'OperativeController'
        ]);
        Permission::create([
            'name' => 'Manage Jobs',
            'controller' => 'JobController'
        ]);
        Permission::create([
            'name' => 'Manage Forms',
            'controller' => 'FormController'
        ]);
        Permission::create([
            'name' => 'Manage Stages',
            'controller' => 'StagesController'
        ]);
    }
}
