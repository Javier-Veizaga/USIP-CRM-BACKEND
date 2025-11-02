<?php

namespace Database\Seeders;

use App\Models\AgreementType;
use Illuminate\Database\Seeder;

class AgreementTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['title' => 'Full',    'description' => 'Convenio total'],
            ['title' => 'Partial', 'description' => 'Convenio parcial'],
        ] as $row) {
            AgreementType::updateOrCreate(['title' => $row['title']], $row);
        }
    }
}
