<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\District;

class AssignmentArea extends Model
{
    protected $fillable = [
        'area',
        'total_population',
        'total_head_of_family',
        'total_of_male',
        'total_of_female',
        'pimpinan_id',
        'anggota_id',
        'user_id',
        'district_id',
    ];

    public function anggota()
    {
        return $this->belongsTo(User::class, 'anggota_id');
    }

    public function pimpinan()
    {
        return $this->belongsTo(User::class, 'pimpinan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
