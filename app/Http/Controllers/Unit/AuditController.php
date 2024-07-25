<?php

namespace App\Http\Controllers\Unit;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    private function getUser()
    {
        if (auth()->user()->role == UserRole::UNIT_JURUSAN)
            return auth()->user()->jurusan;

        return auth()->user()->prodi;
    }

    private function findAudit($id)
    {
        return $this->getUser()->audits()->findOrFail($id);
    }

    public function index(Request $request) {
        $audits = $this->getUser()->audits()
            ->where('cycle_id', $request->session()->get('cycle_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('unit.audits.index', compact('audits'));
    }

    public function lock($id, Request $request) {
        $this->getUser()->audits()->findOrFail($id)->update([ 'is_locked' => true ]);

        alert()->success('Berhasil', 'Berhasil mengunci audit');
        return redirect()->back();
    }

    public function indexMechanism($id)
    {
        $audit = $this->findAudit($id);
        $mechanisms = $audit->mechanisms()->get();

        return view('unit.mechanisms.index', compact('audit', 'mechanisms'));
    }

    public function indexAuditStandard($id) 
    {
        $audit = $this->findAudit($id);
        $standards = $audit->auditStandards()->with('standard', 'incompatibility')->paginate(10);

        return view('unit.audit-standards.index', compact('audit',  'standards'));
    }

    public function showAuditStandard($id, $auditStandardId) 
    {
        $audit = $this->findAudit($id);
        $auditStandard = $audit->auditStandards()->findOrFail($auditStandardId);
        $standard = $auditStandard->standard;

        return view('unit.audit-standards.detail', compact('audit',  'standard'));
    }

    public function indexConclusion($id) 
    {
        $audit = $this->findAudit($id);

        return view('unit.conclusions.edit', compact('audit'));
    }
}
