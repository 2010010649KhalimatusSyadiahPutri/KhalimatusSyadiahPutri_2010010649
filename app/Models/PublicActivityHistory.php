<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicActivityHistory extends Model
{
    use HasFactory;

    protected $table = 'public_activity_histories';

    protected $fillable = [
        'status',
        'public_activity_id',
    ];

}
