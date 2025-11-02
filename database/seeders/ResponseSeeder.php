<?php

namespace Database\Seeders;

use App\Models\Response;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['response' => 'Positive',  'description' => null],
            ['response' => 'Negative',  'description' => null],
            ['response' => 'Pending',   'description' => null],
        ] as $row) {
            Response::updateOrCreate(['response' => $row['response']], $row);
        }
    }
}

