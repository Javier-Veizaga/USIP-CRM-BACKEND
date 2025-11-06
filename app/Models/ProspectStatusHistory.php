<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProspectStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'prospect_status_history';

    protected $fillable = [
        'prospect_id',
        'status_id',
        'user_id',
        'description',
    ];

    protected static function booted()
    {
        static::updating(function () {
            throw new \RuntimeException('History is immutable: updates are not allowed.');
        });

        static::deleting(function () {
            throw new \RuntimeException('History is immutable: deletes are not allowed.');
        });
    }
    public function prospect() { return $this->belongsTo(Prospect::class, 'prospect_id'); }
    public function status()   { return $this->belongsTo(Status::class, 'status_id'); }
    public function user()     { return $this->belongsTo(User::class, 'user_id'); }
}
