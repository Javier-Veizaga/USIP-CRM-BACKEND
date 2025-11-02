<?php

namespace Database\Seeders;

use App\Models\SchoolShift;
use Illuminate\Database\Seeder;

class SchoolShiftSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['shift' => 'morning', 'description' => 'Mañana'],
            ['shift' => 'afternoon', 'description' => 'Tarde'],
            ['shift' => 'evening', 'description' => 'Noche'],
        ] as $row) {
            SchoolShift::updateOrCreate(['shift' => $row['shift']], $row);
        }
    }
}
