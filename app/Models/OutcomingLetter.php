<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutcomingLetter extends Model
{
    protected $fillable = [
        'reference_number',
        'type',
        'purpose',
        'date',
        'sender',
        'review_content',
        'base_content',
        'status',
        'to',
        'signature_name',
        'copy_of_letters',
        'user_id',
    ];

    public function signature()
    {
        return $this->belongsTo(User::class, 'signature_name');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
