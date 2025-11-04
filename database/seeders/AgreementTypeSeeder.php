<?php

namespace Database\Seeders;

use App\Models\AgreementType;
use Illuminate\Database\Seeder;

class AgreementTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Academic',     'description' => 'Convenios académicos generales'],
            ['name' => 'Discount',     'description' => 'Convenios de descuentos / becas'],
            ['name' => 'Internship',   'description' => 'Prácticas y pasantías'],
            ['name' => 'Cooperation',  'description' => 'Cooperación institucional'],
        ] as $row) {
            AgreementType::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}
