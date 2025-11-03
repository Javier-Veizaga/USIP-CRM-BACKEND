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
            ['response' => 'Negative',  'description' => "El prospecto no mostro interés y declinó formalmente el ingreso."],
            ['response' => 'Pending',   'description' => "El prospecto necesita consultar con terceros "],
        ] as $row) {
            Response::updateOrCreate(['response' => $row['response']], $row);
        }
    }
}

