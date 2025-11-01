<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // importante para login
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // si planeas API tokens

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $table = 'users';
    // protected $primaryKey = 'id';
    // public $timestamps = true;

    /**
     * Campos asignables masivamente.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'maternal_last_name',
        'email',
        'role_id',
        'phone',
        // Si luego agregas password, recuérdalo aquí y en $hidden/$casts.
    ];

    /**
     * Ocultar atributos sensibles cuando serializas a arrays/JSON.
     * (Si agregas password o tokens, colócalos aquí).
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * Casts de columnas (ej. fechas/booleans/json).
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    /**
     * Relación: User pertenece a un Role.
     * users.role_id  --> roles.id
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * Relación: User tiene muchos Prospects (como ejecutivo asignado).
     * prospects.user_id --> users.id
     */
    public function prospects()
    {
        return $this->hasMany(Prospect::class, 'user_id', 'id');
    }

    /**
     * Relación: User tiene muchas Actions (acciones ejecutadas por este usuario).
     * actions.user_id --> users.id
     */
    public function actions()
    {
        return $this->hasMany(Action::class, 'user_id', 'id');
    }

    /**
     * Relación: User tiene muchos registros de cambio de estado de prospectos.
     * prospect_status_history.user_id --> users.id
     */
    public function prospectStatusHistory()
    {
        return $this->hasMany(ProspectStatusHistory::class, 'user_id', 'id');
    }

    /**
     * Accessor útil: nombre completo.
     * Uso: $user->full_name
     */
    public function getFullNameAttribute(): string
    {
        // Maneja nulls de maternal_last_name de forma elegante
        return trim($this->first_name.' '.$this->last_name.' '.($this->maternal_last_name ?? ''));
    }

    /**
     * Scope práctico: filtrar por rol (por code del rol).
     * Ej: User::withRole('executive')->get();
     */
    public function scopeWithRole($query, string $roleCode)
    {
        return $query->whereHas('role', fn($q) => $q->where('code', $roleCode));
    }
}
