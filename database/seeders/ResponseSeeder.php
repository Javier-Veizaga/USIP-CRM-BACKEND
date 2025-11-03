<?php

namespace Database\Seeders;

use App\Models\Response;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['response' => 'Positive',  'description' => "El prospecto mostró interés."],
            ['response' => 'Negative',  'description' => "El prospecto declinó formalmente el interés."],
            ['response' => 'Pending',   'description' => "El prospecto necesita consultar con terceros (padres, pareja, empleador) o pidió ser contactado en una fecha específica para tomar la decisión."],
        ] as $row) {
            Response::updateOrCreate(['response' => $row['response']], $row);
        }
    }
}

