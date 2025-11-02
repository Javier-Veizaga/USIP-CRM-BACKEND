<?php

namespace Database\Seeders;

use App\Models\DataSource;
use Illuminate\Database\Seeder;

class DataSourceSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Organic'],
            ['name' => 'Referral'],
            ['name' => 'Campaign'],
            ['name' => 'Walk-in'],
        ] as $row) {
            DataSource::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}

