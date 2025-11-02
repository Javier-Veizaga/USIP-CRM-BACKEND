<?php

namespace Database\Seeders;

use App\Models\SchoolManagement;
use Illuminate\Database\Seeder;

class SchoolManagementSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['term' => 'public',  'description' => 'Fiscal'],
            ['term' => 'private', 'description' => 'Privado'],
            ['term' => 'hybrid',  'description' => 'Convenio/Híbrido'],
        ] as $row) {
            SchoolManagement::updateOrCreate(['term' => $row['term']], $row);
        }
    }
}

