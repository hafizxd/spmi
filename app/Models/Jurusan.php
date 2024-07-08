<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    public $table = 'jurusan';

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function prodi() {
        return $this->hasMany(Prodi::class);
    }
}
