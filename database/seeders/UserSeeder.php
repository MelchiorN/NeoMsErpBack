<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'last_name' => 'Admin',
            'first_name' => 'Super',
            'phone' => '22897453653',
            'email' => 'admin@example.com',
            'login' => 'admin',
            'password' => Hash::make('password'),
            'hired_year' => now(),

        ]);
    }
}
