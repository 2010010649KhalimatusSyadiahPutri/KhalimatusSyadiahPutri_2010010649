<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficerFacility extends Model
{
    protected $table = 'facilities';

    protected $fillable = [
        'type',
        'name',
        'description',
        'quantity',
        'maintenance_time',
        'condition',
        'officer_id',
        'image',
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }
}