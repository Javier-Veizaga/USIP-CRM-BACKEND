<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActionCatalog;

class ActionCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['name' => 'Call',    'description' => 'Llamada telefónica', 'is_active' => true],
            ['name' => 'Message', 'description' => 'WhatsApp / SMS',     'is_active' => true],
            ['name' => 'Visit',   'description' => 'Visita presencial',  'is_active' => true],
            ['name' => 'Meeting', 'description' => 'Reunión agendada',   'is_active' => true],
        ];

        foreach ($rows as $row) {
            ActionCatalog::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}
