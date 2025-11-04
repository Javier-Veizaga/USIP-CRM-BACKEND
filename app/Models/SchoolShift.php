<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolShift extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function setNameAttribute($v): void
    {
        $this->attributes['name'] = mb_convert_case(trim((string)$v), MB_CASE_TITLE, 'UTF-8');
    }

    // Relación (si luego la usas): un turno tiene muchos colegios
    public function schools()
    {
        return $this->hasMany(School::class, 'school_shift_id', 'id');
    }
}
