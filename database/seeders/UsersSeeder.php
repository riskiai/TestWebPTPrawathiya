<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

          // Insert users into the users table
          DB::table('users')->insert([
            [
                'name' => 'Riski Admin',
                'email' => 'admin@example.com',
                'role_id' => 1, // buat admin
                'password' => Hash::make('password123'), // Encrypt password
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
