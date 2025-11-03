<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    // Relaciones
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    // Scope útil
    public function scopeByCode($query, string $code)
    {
        return $query->where('code', $code);
    }

    /* ================== Mutators opcionales ================== */
    // Guarda el code siempre normalizado: minúsculas y sin espacios
    public function setCodeAttribute($value): void
    {
        $this->attributes['code'] = strtolower(trim($value));
    }

    // Guarda el name en Title Case (primeras letras en mayúscula)
    public function setNameAttribute($value): void
    {
        // Soporta tildes/UTF-8
        $this->attributes['name'] = mb_convert_case(trim($value), MB_CASE_TITLE, 'UTF-8');
    }
}
