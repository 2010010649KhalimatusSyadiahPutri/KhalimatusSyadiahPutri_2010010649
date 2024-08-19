<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    // untuk terhubung dengan table maka diisi dengan nama table
    protected $table = "positions";

    // kolom yang diizinkan di isi / create secara masal
    protected $fillable = [
        "name"
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'position_id');
    }
}
