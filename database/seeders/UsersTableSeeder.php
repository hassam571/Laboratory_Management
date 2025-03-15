<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Hassam Admin',
                'email' => 'a@a',
                'password' => Hash::make('a'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Receptionist User',
                'email' => 'r@r',
                'password' => Hash::make('a'),
                'role' => 'receptionist',
                'status' => 'active',
            ],
            [
                'name' => 'Reporter User',
                'email' => 'rp@r',
                'password' => Hash::make('a'),
                'role' => 'reporter',
                'status' => 'active',
            ],
            [
                'name' => 'Sampler User',
                'email' => 's@s',
                'password' => Hash::make('a'),
                'role' => 'sampler',
                'status' => 'active',
            ],
            [
                'name' => 'Patient User',
                'email' => 'p@p',
                'password' => Hash::make('a'),
                'role' => 'patient',
                'status' => 'active',
            ],
            [
                'name' => 'Manager User',
                'email' => 'm@m',
                'password' => Hash::make('a'),
                'role' => 'manager',
                'status' => 'active',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
