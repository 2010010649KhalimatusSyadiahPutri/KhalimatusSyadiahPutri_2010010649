<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicActivityAttachment extends Model
{
    use HasFactory;

    protected $table = 'public_activity_attachments';

    protected $fillable = [
        'path',
        'public_activity_history_id',
        'public_activity_id',
    ];

    public function getFileLinkAttribute()
    {
        return url('storage/'.$this->path);
    }
}