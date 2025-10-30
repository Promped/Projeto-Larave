<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@test.local'],
            ['name' => 'Admin Test', 'password' => Hash::make('senha123'), 'nivel' => 'ADM']
        );

        User::updateOrCreate(
            ['email' => 'cliente@test.local'],
            ['name' => 'Cliente Test', 'password' => Hash::make('senha123'), 'nivel' => 'CLI']
        );
    }
}
