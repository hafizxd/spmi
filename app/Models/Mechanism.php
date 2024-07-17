<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanism extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }
}
