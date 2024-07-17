<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditStandard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function incompatibility()
    {
        return $this->belongsTo(Incompatibility::class);
    }
}
