<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\Incompatibility;
use Illuminate\Http\Request;
use App\Models\Audit;

class AuditStandardController extends Controller
{
    private function findAudit($id)
    {
        $auditorId = auth()->user()->auditor->id;
        $audit = Audit::where(function($query) use ($auditorId) {
            $query->where('auditor_1_id', $auditorId)
            ->orWhere('auditor_2_id', $auditorId)
            ->orWhere('auditor_3_id', $auditorId);
        })
        ->findOrFail($id);

        return $audit;
    }

    public function index($id) 
    {
        $audit = $this->findAudit($id);
        $standards = $audit->auditStandards()->with('standard', 'incompatibility')->paginate(10);

        return view('auditor.audit-standards.index', compact('audit',  'standards'));
    }

    public function save($id) 
    {
        $this->findAudit($id)->update([ 'is_audit' => true ]);

        alert()->success('Berhasil', 'Berhasil menyimpan perbaikan audit');
        return redirect()->route('auditor.audits.index');
    }

    public function edit($id, $auditStandardId) 
    {
        $audit = $this->findAudit($id);
        $standard = $audit->auditStandards()->findOrFail($auditStandardId);
        $incompatibilities = Incompatibility::all();

        return view('auditor.audit-standards.edit', compact('audit', 'standard', 'incompatibilities'));
    }

    public function update($id, $auditStandardId, Request $request)
    {
        $request->validate([
            'incompatibility_id' => 'required|exists:incompatibilities,id',
            'incompatibility_note' => 'nullable',
            'status' => 'required'
        ]);

        $audit = $this->findAudit($id);
        $standard = $audit->auditStandards()->findOrFail($auditStandardId);

        $standard->update([
            'incompatibility_id' => $request->incompatibility_id,
            'incompatibility_note' => $request->incompatibility_note,
            'repairment_status' => $request->status
        ]);

        alert()->success('Berhasil', 'Berhasil menyimpan data');
        return redirect()->route('auditor.audits.audit_standards.index', $id);
    }
}
