<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    public $table = 'audits';

    protected $guarded = [];

    public function cycle() {
        return $this->belongsTo(Cycle::class);
    }
    
    public function jurusan() {
        return $this->belongsTo(Jurusan::class);
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class);
    }

    public function auditor1() {
        return $this->belongsTo(Auditor::class, 'auditor_1_id', 'id');
    }

    public function auditor2() {
        return $this->belongsTo(Auditor::class, 'auditor_2_id', 'id');
    }

    public function auditor3() {
        return $this->belongsTo(Auditor::class, 'auditor_3_id', 'id');
    }

    public function mechanisms() {
        return $this->hasMany(Mechanism::class);
    }

    public function auditStandards() {
        return $this->hasMany(AuditStandard::class);
    }

    public function conclusion() {
        return $this->hasOne(Conclusion::class);
    }
}
