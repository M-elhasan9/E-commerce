<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => "admin",
            'email' => "admin@gmail.com",
            'phone' => "05531777777",
            'is_admin' => 1,
            'password' => Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => "admin2",
            'email' => "admin2@gmail.com",
            'phone' => "05531777777",
            'is_admin' => 1,
            'password' => Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'name' => "user",
            'email' => "user@gmail.com",
            'phone' => "05531777777",
            'is_admin' => 0,
            'password' => Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'name' => "user2",
            'email' => "user2@gmail.com",
            'phone' => "05531777777",
            'is_admin' => 0,
            'password' => Hash::make('12345678')
        ]);
    }
}
