<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;

    public $table = 'auditors';

    protected $guarded = [];

    public function jurusan() {
        return $this->belongsTo(Jurusan::class);
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
