<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function setNameAttribute($v): void
    {
        $this->attributes['name'] = mb_convert_case(trim((string)$v), MB_CASE_TITLE, 'UTF-8');
    }

    // CORRECTO: una facultad tiene muchos cursos
    public function courses()
    {
        return $this->hasMany(Course::class, 'faculty_id', 'id');
    }
}
