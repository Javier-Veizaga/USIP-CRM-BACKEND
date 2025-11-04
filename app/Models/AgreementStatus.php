<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgreementStatus extends Model
{
    use HasFactory;

    protected $table = 'agreement_statuses';
    protected $fillable = ['name', 'description'];

    public function setNameAttribute($v): void
    {
        $this->attributes['name'] = mb_convert_case(trim((string)$v), MB_CASE_TITLE, 'UTF-8');
    }
}
