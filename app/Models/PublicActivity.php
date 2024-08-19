<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicActivity extends Model
{
    protected $fillable = [
        'time',
        'title',
        'description',
        'assignment_area_id',
        'officer_id',
        'user_id',
    ];

    public function assignment_area()
    {
        return $this->belongsTo(AssignmentArea::class, 'assignment_area_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function histories()
    {
        return $this->hasMany(PublicActivityHistory::class, 'public_activity_id');
    }

    public function attachments()
    {
        return $this->hasMany(PublicActivityAttachment::class, 'public_activity_id');
    }
}
