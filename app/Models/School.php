<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'school_management_id',
        'school_shift_id',
        'agreement_type_id',
        'agreement_status_id',
        'address',
    ];

    public function setNameAttribute($v): void
    {
        $this->attributes['name'] = mb_convert_case(trim((string)$v), MB_CASE_TITLE, 'UTF-8');
    }

    public function management()
    {
        return $this->belongsTo(SchoolManagement::class, 'school_management_id');
    }

    public function shift()
    {
        return $this->belongsTo(SchoolShift::class, 'school_shift_id');
    }

    public function agreementType()
    {
        return $this->belongsTo(AgreementType::class, 'agreement_type_id');
    }

    public function agreementStatus()
    {
        return $this->belongsTo(AgreementStatus::class, 'agreement_status_id');
    }
}
