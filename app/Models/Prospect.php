<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prospect extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'maternal_last_name',
        'phone',
        'school_id',
        'address',
        'data_origin_id',
        'user_id',
        'status_id',
    ];

    // Normaliza strings básicos
    public function setFirstNameAttribute($v){ $this->attributes['first_name'] = trim((string)$v); }
    public function setLastNameAttribute($v){ $this->attributes['last_name'] = trim((string)$v); }
    public function setMaternalLastNameAttribute($v){ $this->attributes['maternal_last_name'] = $v ? trim((string)$v) : null; }
    public function setAddressAttribute($v){ $this->attributes['address'] = trim((string)$v); }

    // Relaciones
    public function school(){ return $this->belongsTo(School::class, 'school_id'); }
    public function origin(){ return $this->belongsTo(\App\Models\DataSource::class, 'data_origin_id'); }
    public function executive(){ return $this->belongsTo(\App\Models\User::class, 'user_id'); }
    public function status(){ return $this->belongsTo(\App\Models\Status::class, 'status_id'); }

    public function statusHistory(){ return $this->hasMany(\App\Models\ProspectStatusHistory::class, 'prospect_id'); }
}
