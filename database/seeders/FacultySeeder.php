<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Ciencias Económicas y Empresariales '],
            ['name' => 'Ingeniería'],
            ['name' => 'Ciencias y Artes'],
            ['name' => 'Ciencias Sociales'],
            ['name' => 'Ciencias del Medio Ambiente'],
        ] as $row) {
            Faculty::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}
