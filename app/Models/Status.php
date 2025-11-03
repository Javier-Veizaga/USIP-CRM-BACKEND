<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 
        'description'
    ];

    
    public function setStatusAttribute($value): void
    {
        $v = trim((string)$value);
        $v = mb_strtolower($v, 'UTF-8');
        $this->attributes['status'] =
            mb_strtoupper(mb_substr($v, 0, 1, 'UTF-8'), 'UTF-8') .
            mb_substr($v, 1, null, 'UTF-8');
    }

    // Relación (si llevas historial): un estado se usa en muchos cambios
    public function prospectStatusHistory()
    {
        return $this->hasMany(ProspectStatusHistory::class, 'status_id', 'id');
    }
}
