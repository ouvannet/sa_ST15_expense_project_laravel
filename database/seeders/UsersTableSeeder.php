<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tbl_user')->insert([
            'name' => 'seyha',
            'gender' => 'male',
            'dob' => '2024-12-08',
            'email' => 'seyha@gmail.com',
            'phone' => '0123456789',
            'password' => Hash::make('123'),
            'department_id' => 1,
            'role_id' => 1
        ]);
    }
}
