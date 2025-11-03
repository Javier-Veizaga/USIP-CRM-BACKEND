<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionCatalog extends Model
{
    use HasFactory;

    // IMPORTANTE: tu tabla es "actions_catalog", no la plural por defecto
    protected $table = 'actions_catalog';

    // Habilita create() / update() seguros
    protected $fillable = [
        'name',
        'description',
        'is_active'
        // 'is_active', // <- solo si agregaste este campo en la migración
    ];

    protected $cast = [
        'is_active' => 'boolean',
    ];
    // Relaciones: un tipo de acción tiene muchas acciones registradas
    public function actions()
    {
        // En tu esquema, la FK en actions es "action_id"
        return $this->hasMany(Action::class, 'action_id', 'id');
    }
}
