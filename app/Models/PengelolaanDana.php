<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengelolaanDana extends Model
{
    use HasFactory;

    protected $table = 'pengelolaan_dana';

    protected $fillable = [
        'tanggal',
        'jenis',
        'nominal',
        'keterangan',
    ];
}
