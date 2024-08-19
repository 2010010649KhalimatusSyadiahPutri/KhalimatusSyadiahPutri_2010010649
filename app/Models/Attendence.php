<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $fillable = [
        'status',
        'notes',
        'anggota_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'anggota_id');
    }
}
