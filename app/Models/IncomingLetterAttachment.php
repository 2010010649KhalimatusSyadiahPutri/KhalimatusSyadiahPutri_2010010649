<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingLetterAttachment extends Model
{
    use HasFactory;

    protected $table = 'incoming_message_attachments';

    protected $fillable = [
        'path',
        'incoming_message_id',
    ];

    public function getFileLinkAttribute()
    {
        return asset('storage/'. $this->path);
    }
}
