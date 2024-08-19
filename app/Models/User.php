<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'fullname',
        'rank_id',
        'position_id',
        'branching_id',
        'nrp',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    // kalau pakai belongs ini tujuannya untuk relasi ke PARENT atau si table punya FK dari table yang lain -> FK Rank_id -> PK Table Rank
    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function branching()
    {
        return $this->belongsTo(Branching::class, 'branching_id');
    }
}
