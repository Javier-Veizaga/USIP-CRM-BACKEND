<?php

namespace Database\Seeders;

use App\Models\ActionCatalog;
use Illuminate\Database\Seeder;

class ActionCatalogSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Call',     'description' => 'Teléfono'],
            ['name' => 'Message',  'description' => 'WhatsApp/SMS'],
            ['name' => 'Visit',    'description' => 'Visita ATN'],
            ['name' => 'Meeting',  'description' => 'Cita/ATP'],
        ] as $row) {
            ActionCatalog::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}
