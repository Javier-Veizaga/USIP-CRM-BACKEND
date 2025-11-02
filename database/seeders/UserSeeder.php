<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = Role::where('code', 'administrator')->value('id') ?? 1;

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name'         => 'Admin',
                'last_name'          => 'Root',
                'maternal_last_name' => null,
                'phone'              => '+59170000000',
                'role_id'            => $adminRoleId,
                'is_active'          => true,
                'password'           => Hash::make('Secret123*'),
            ]
        );

        // Ejecutivo demo (opcional)
        $execRoleId = Role::where('code', 'executive')->value('id');
        if ($execRoleId) {
            User::updateOrCreate(
                ['email' => 'exec@example.com'],
                [
                    'first_name' => 'Eva',
                    'last_name'  => 'Quispe',
                    'phone'      => '+59170000001',
                    'role_id'    => $execRoleId,
                    'is_active'  => true,
                    'password'   => Hash::make('Secret123*'),
                ]
            );
        }
    }
}
