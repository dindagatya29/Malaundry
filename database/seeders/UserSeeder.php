<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('290303'), 
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'password' => Hash::make('password456'), 
            ],
        ]);
    }
}
