<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            ['name' => 'Ingeniería Financiera', 'semesters' => '4', 'faculty_id' => 1],
            ['name' => 'Ingeniería Comercial', 'semesters' => '4', 'faculty_id' => 1],
            ['name' => 'Administración de Empresas', 'semesters' => '4', 'faculty_id' => 1],

            ['name' => 'Ingeniería de Telecomunicaciones', 'semesters' => '4', 'faculty_id' => 2],
            ['name' => 'Ingeniería de Sistemas', 'semesters' => '4', 'faculty_id' => 2],
            ['name' => 'Ingeniería Electromecánica', 'semesters' => '4', 'faculty_id' => 2],

            ['name' => 'Arquitectura', 'semesters' => '4', 'faculty_id' => 3],
            ['name' => 'Matemáticas', 'semesters' => '4', 'faculty_id' => 3],

            ['name' => 'Derecho', 'semesters' => '4', 'faculty_id' => 4],

            ['name' => 'Ingeniería Ambiental', 'semesters' => '4', 'faculty_id' => 5],
        ] as $row){
            Course::updateOrCreate(['name'=> $row['name']], $row);
        }
    }
}
