<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conclusion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }
}
