<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operational extends Model
{
    protected $table = 'operationals';

    protected $fillable = [
        'date',
        'type',
        'total',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class, 'operational_id');
    }
}
