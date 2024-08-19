<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
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
}
