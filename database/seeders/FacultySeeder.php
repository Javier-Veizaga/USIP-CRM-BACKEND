<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Engineering'],
            ['name' => 'Health Sciences'],
            ['name' => 'Business'],
            ['name' => 'Education'],
        ] as $row) {
            Faculty::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}
