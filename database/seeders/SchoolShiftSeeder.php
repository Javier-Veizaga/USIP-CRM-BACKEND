<?php

namespace Database\Seeders;

use App\Models\SchoolShift;
use Illuminate\Database\Seeder;

class SchoolShiftSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'morning', 'description' => 'Mañana'],
            ['name' => 'afternoon', 'description' => 'Tarde'],
            ['name' => 'evening', 'description' => 'Noche'],
        ] as $row) {
            SchoolShift::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}
