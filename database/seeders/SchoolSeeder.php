<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        foreach(
            [
                ['name' => 'Colegio San Martin', 'address' => 'Av. Los Libertadores N°123, Zona Central', 'school_management_id' => 1, 
                    'school_shift_id' => 1, 'agreement_type_id' => 1, 'agreement_status_id' => 1],
                ['name' => 'Unidad Educativa Bilingüe', 'address' => 'Calle Secundaria N° 456, Barrio Norte', 'school_management_id' => 2, 
                    'school_shift_id' => 2, 'agreement_type_id' => 2, 'agreement_status_id' => 2],
                ['name' => 'Escuela Técnica Industrial', 'address' => 'Carretera Vieja Km 5, Parque Industrial', 'school_management_id' => 1,      
                    'school_shift_id' => 3, 'agreement_type_id' => 1, 'agreement_status_id' => 1],
            ] as $row ) {
            School::updateOrCreate(['name' => $row['name']], $row);
        }
    }
}
