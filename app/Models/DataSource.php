<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSource extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Opcional: Title Case automático
    public function setNameAttribute($v): void
    {
        $v = trim((string)$v);
        $this->attributes['name'] = mb_convert_case($v, MB_CASE_TITLE, 'UTF-8');
    }
}
