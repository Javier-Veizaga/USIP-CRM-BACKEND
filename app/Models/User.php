<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'maternal_last_name',
        'email',
        'role_id',
        'phone',
        'password',    
        'is_active',
    ];

    protected $hidden = [
        'password',     
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // (Opcional) incluir en JSON
    // protected $appends = ['full_name'];

    /* ---------------- Relaciones ---------------- */
    public function role() { return $this->belongsTo(Role::class, 'role_id', 'id'); }
    public function prospects() { return $this->hasMany(Prospect::class, 'user_id', 'id'); }
    public function actions() { return $this->hasMany(Action::class, 'user_id', 'id'); }
    public function prospectStatusHistory() { return $this->hasMany(ProspectStatusHistory::class, 'user_id', 'id'); }

    /* ---------------- Accessors / Scopes ---------------- */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.$this->last_name.' '.($this->maternal_last_name ?? ''));
    }

    public function scopeWithRole($query, string $roleCode)
    {
        return $query->whereHas('role', fn($q) => $q->where('code', $roleCode));
    }

    /* ---------------- Mutators ---------------- */
    // Guarda siempre la contraseña hasheada
    public function setPasswordAttribute($value): void
    {
        if (!$value) return;
        // Evita rehashear si ya viene con hash
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }
}
