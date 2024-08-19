<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    // untuk terhubung dengan table maka diisi dengan nama table
    protected $table = "ranks";

    // kolom yang diizinkan di isi / create secara masal
    protected $fillable = [
        "name"
    ];
}
