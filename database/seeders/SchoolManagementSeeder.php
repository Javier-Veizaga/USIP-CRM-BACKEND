<?php

namespace Database\Seeders;

use App\Models\SchoolManagement;
use Illuminate\Database\Seeder;

class SchoolManagementSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'public',  'description' => 'Fiscal'],
            ['name' => 'private', 'description' => 'Privado'],
            ['name' => 'hybrid',  'description' => 'Convenio/Híbrido'],
        ] as $row) {
            SchoolManagement::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}

