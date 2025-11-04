<?php

namespace Database\Seeders;

use App\Models\DataSource;
use Illuminate\Database\Seeder;

class DataSourceSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Búsqueda Orgánica'],
            ['name' => 'Publicidad en Buscadores'],
            ['name' => 'Redes Sociales Orgánicas'],
            ['name' => 'Publicidad en Redes Sociales'],
            ['name' => 'Recomendación y Contactos Personales'],
            ['name' => 'Eventos y Presencia Offline'],
            ['name' => 'Otros Canales'],
        ] as $row) {
            DataSource::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}

