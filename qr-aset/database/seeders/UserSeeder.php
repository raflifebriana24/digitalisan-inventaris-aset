<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Admin Diskominfo Kota Serang',
            'email' => 'admin@diskominfo.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Operator Diskominfo Kota Serang',
            'email' => 'operator@diskominfo.com',
            'password' => Hash::make('password'),
            'role' => 'operator',
        ]);
    }
}
