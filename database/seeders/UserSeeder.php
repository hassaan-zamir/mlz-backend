<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Zafir',
            'email' => 'admin@mlz.com',
            'password' => Hash::make('secret'),
            'type' => 'Manager'
        ]);

        DB::table('users')->insert([
            'name' => 'Client',
            'email' => 'client@mlz.com',
            'password' => Hash::make('secret'),
            'type' => 'Client'
        ]);

        DB::table('users')->insert([
            'name' => 'Guard',
            'email' => 'guard@mlz.com',
            'password' => Hash::make('secret'),
            'type' => 'Guard'
        ]);
    }
}
