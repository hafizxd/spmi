<?php

namespace App\Http\Controllers\Admin\Audits;

use App\Constants\RepairmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\Auditor;
use App\Models\Cycle;
use App\Models\Jurusan;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index() {
        $audits = Audit::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.audits.audits.index', compact('audits'));
    }

    public function create()
    {
        $cycles = Cycle::orderBy('order_no')->get();
        $jurusan = Jurusan::orderBy('name_jurusan')->get();
        $auditors = User::has('auditor')->orderBy('name')->get();

        return view('admin.audits.audits.create', compact('cycles', 'jurusan', 'auditors'));
    }    

    public function store(Request $request) {
        $validatedData = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'prodi_id' => 'required|exists:prodi,id',
            'auditor_1_id' => 'required|exists:auditors,id',
            'auditor_2_id' => 'nullable|exists:auditors,id',
            'auditor_3_id' => 'nullable|exists:auditors,id',
        ]);

        $audit = Audit::create($validatedData);

        $standards = Standard::where('cycle_id', $request->cycle_id)->get();
        foreach ($standards as $value) {
            $audit->auditStandards()->create([
                'standard_id' => $value->id,
                'repairment_status' => RepairmentStatus::NOT
            ]);
        }

        alert()->success('Berhasil', 'Audit berhasil ditambahkan');
        return redirect()->route('admin.audits.audits.index');
    }

    public function edit($id)
    {
        $audit = Audit::findOrFail($id);
        $cycles = Cycle::orderBy('order_no')->get();
        $jurusan = Jurusan::orderBy('name_jurusan')->get();
        $auditors = User::has('auditor')->orderBy('name')->get();

        return view('admin.audits.audits.edit', compact('audit', 'cycles', 'jurusan', 'auditors'));
    }    

    public function update($id, Request $request) {
        $validatedData = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'prodi_id' => 'required|exists:prodi,id',
            'auditor_1_id' => 'required|exists:users,id',
            'auditor_2_id' => 'nullable|exists:users,id',
            'auditor_3_id' => 'nullable|exists:users,id',
        ]);

        $audit = Audit::findOrFail($id);

        if ($audit->cycle_id !== $request->cycle_id) {
            $audit->auditStandards()->delete();

            $standards = Standard::where('cycle_id', $request->cycle_id)->get();
            foreach ($standards as $value) {
                $audit->auditStandards()->create([
                    'standard_id' => $value->id,
                    'repairment_status' => RepairmentStatus::NOT
                ]);
            }
        }

        $audit->update($validatedData);        

        alert()->success('Berhasil', 'Audit berhasil diubah');
        return redirect()->route('admin.audits.audits.index');
    }

    public function destroy(string $id)
    {
        Audit::findOrFail($id)->delete()   ;

        alert()->success('Berhasil', 'Audit berhasil dihapus');
        return redirect()->route('admin.audits.audits.index');
    }
}
