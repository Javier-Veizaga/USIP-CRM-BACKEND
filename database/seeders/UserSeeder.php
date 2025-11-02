<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = Role::where('code', 'administrator')->value('id');

        if ($adminRoleId) {
            User::updateOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'first_name' => 'Admin',
                    'last_name'  => 'Root',
                    'maternal_last_name' => null,
                    'phone'      => '+59170000000',
                    'role_id'    => $adminRoleId,
                    'is_active'  => true,
                    'password'   => Hash::make('Secret123*'),
                ]
            );
        }
    }
}

