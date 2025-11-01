<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Tabla y clave primaria: por convención no hace falta declararlas,
    // pero las dejo comentadas por si algún día cambias nombres.
    // protected $table = 'roles';
    // protected $primaryKey = 'id';

    // Laravel maneja timestamps (created_at, updated_at) porque existen en la migración
    // public $timestamps = true;

    /**
     * Asignación masiva permitida (recomendado sobre $guarded = []).
     */
    protected $fillable = [
        'code',   // 'administrator' | 'supervisor' | 'executive'
        'name',
    ];

    /**
     * Casts (no son estrictamente necesarios aquí, pero útil si luego agregas flags/JSON).
     */
    protected $casts = [
        // 'some_flag' => 'boolean',
    ];

    /**
     * Relación: un rol tiene muchos usuarios.
     * roles.id  <-- users.role_id
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    /**
     * Scope útil para buscar por código normalizado.
     * Ej: Role::byCode('administrator')->first();
     */
    public function scopeByCode($query, string $code)
    {
        return $query->where('code', $code);
    }
}
