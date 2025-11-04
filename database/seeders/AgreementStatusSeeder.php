<?php

namespace Database\Seeders;

use App\Models\AgreementStatus;
use Illuminate\Database\Seeder;

class AgreementStatusSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Active',    'description' => 'Convenio vigente'],
            ['name' => 'Cancelled', 'description' => 'Convenio cancelado'],
            ['name' => 'Expired',   'description' => 'Convenio vencido'],
        ] as $row) {
            AgreementStatus::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}
