<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'manager@gmail.com'],
            [
                'name' => 'Main Manager',
                'password' => Hash::make('Manager@123'),
                'role' => 'manager',
            ]
        );
    }
}
