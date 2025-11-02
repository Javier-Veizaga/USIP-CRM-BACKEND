<?php

namespace Database\Seeders;

use App\Models\AgreementStatus;
use Illuminate\Database\Seeder;

class AgreementStatusSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['status' => 'ACTIVE'],
            ['status' => 'CANCELLED'],
        ] as $row) {
            AgreementStatus::updateOrCreate(['status' => $row['status']], $row);
        }
    }
}
