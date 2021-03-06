<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // add a row to admin table
        DB::table('admins')->insert([
            'name' => 'Yetekan Admin',
            'email' => 'yetekan_admin@gmail.com',
            'confirmed' => 1,
            'password' => Hash::make('d8caaemho2j8ls'),
        ]);
        // user demo
        DB::table('comptes')->insert([
            'first_name' => 'user',
            'last_name' => 'user',
            'email' => 'userdemo@gmail.com',
            'confirmed' => 1,
            'phone_verified' => 1,
            'password' => Hash::make('userdemo'),
        ]);
    }
}
