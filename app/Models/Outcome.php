<?php

namespace App\Models;

use App\Models\User;
use App\Models\Operational;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $table = 'outcomes';

    protected $fillable = [
        'date',
        'type',
        'total',
        'description',
        'report',
        'operational_id',
        'user_id'
    ];

    public function getReportLinkAttribute()
    {
        if ($this->report) {
            return asset('storage/'. $this->report);
        }

        return url('404');
    }

    public function sumber_dana()
    {
        return $this->belongsTo(Operational::class, 'operational_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
