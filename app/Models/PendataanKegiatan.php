<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendataanKegiatan extends Model
{
    use HasFactory;

    protected $table = 'officer_activities';

    protected $fillable = [
        'tanggal',
        'jenis',
        'deskripsi',
        'user_id',
    ];

    /**
     * Get the user that owns the PendataanKegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
