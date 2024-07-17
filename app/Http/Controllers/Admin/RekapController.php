<?php

namespace App\Http\Controllers\Admin;

use App\Constants\RepairmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\AuditStandard;
use App\Models\File;
use App\Models\Cycle;
use App\Models\Incompatibility;
use App\Models\Jurusan;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index() {
        $incompatibilities = Incompatibility::select('id', 'name')->get();

        $audits = Audit::selectRaw('DISTINCT(prodi_id)')->with('prodi')->paginate(10);
        
        foreach ($audits as $key => $value) {
            $standards = AuditStandard::whereRelation('audit', 'prodi_id', $value->prodi_id)->get();
            $ktsTemp = [];

            foreach ($standards as $standard) {
                if (empty($standard->incompatibility_id)) continue;

                if (isset($ktsTemp[$standard->incompatibility_id])) {
                    $ktsTemp[$standard->incompatibility_id]++;
                } else {
                    $ktsTemp[$standard->incompatibility_id] = 1;
                }
            }

            $audits[$key]->kts = $ktsTemp;
        }

        return view('admin.rekap.index', compact('audits', 'incompatibilities'));
    }
}
