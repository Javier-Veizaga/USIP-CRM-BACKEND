<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            ['code' => 'administrator', 'name' => 'Administrator'],
            ['code' => 'supervisor', 'name' => 'Supervisor'],
            ['code' => 'executive', 'name' => 'Executive'],
        ] as $row){
            Role::updateOrCreate(['code'=> $row['code']], $row);
        }
    }
}
