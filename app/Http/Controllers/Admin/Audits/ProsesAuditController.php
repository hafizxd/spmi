<?php

namespace App\Http\Controllers\Admin\Audits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audit;

class ProsesAuditController extends Controller
{
    public function index(Request $request) {
        $audits = Audit::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.proses-audits.audits.index', compact('audits'));
    }

    public function lock($id, Request $request) {
        Audit::findOrFail($id)->update([ 'is_locked' => true ]);

        alert()->success('Berhasil', 'Berhasil mengunci audit');
        return redirect()->back();
    }

    public function indexMechanism($id)
    {
        $audit = Audit::findOrFail($id);
        $mechanisms = $audit->mechanisms()->get();

        return view('admin.proses-audits.mechanisms.index', compact('audit', 'mechanisms'));
    }

    public function indexAuditStandard($id) 
    {
        $audit = Audit::findOrFail($id);
        $standards = $audit->auditStandards()->with('standard', 'incompatibility')->paginate(10);

        return view('admin.proses-audits.audit-standards.index', compact('audit',  'standards'));
    }

    public function indexConclusion($id) 
    {
        $audit = Audit::findOrFail($id);

        return view('admin.proses-audits.conclusions.edit', compact('audit'));
    }
}
