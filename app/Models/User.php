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

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function jurusan() {
        return $this->hasOne(Jurusan::class, 'user_id', 'id');
    }

    public function prodi() {
        return $this->hasOne(Prodi::class, 'user_id', 'id');
    }

    public function auditor() {
        return $this->hasOne(Auditor::class, 'user_id', 'id');
    }
}
