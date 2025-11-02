<?php
namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['status' => 'enquiry',   'description' => 'Consulta inicial'],
            ['status' => 'pending',   'description' => 'Pendiente'],
            ['status' => 'negative',  'description' => 'No interesado'],
            ['status' => 'enrolled',  'description' => 'Inscrito'],
        ] as $row) {
            Status::updateOrCreate(['status' => $row['status']], $row);
        }
    }
}
