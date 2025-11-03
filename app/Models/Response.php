<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;

    // Por convención usa la tabla "responses", así que no hace falta $table.

    // Permitir asignación masiva en create()/update()
    protected $fillable = ['response', 'description'];

    // (Opcional) Normaliza el campo: primera letra mayúscula
    public function setResponseAttribute($value): void
    {
        $v = trim((string)$value);
        $v = mb_strtolower($v, 'UTF-8');
        $this->attributes['response'] =
            mb_strtoupper(mb_substr($v, 0, 1, 'UTF-8'), 'UTF-8') .
            mb_substr($v, 1, null, 'UTF-8');
    }


    public function actions()
    {
        return $this->hasMany(Action::class, 'response_id', 'id');
    }
}
