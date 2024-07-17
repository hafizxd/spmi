<?php

namespace App\Http\Controllers\Auditor;

use App\Constants\RepairmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\Standard;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $auditorId = auth()->user()->auditor->id;

        $audits = Audit::where(function ($query) use ($auditorId) {
            $query->where('auditor_1_id', $auditorId)->orWhere('auditor_2_id', $auditorId)->orWhere('auditor_3_id', $auditorId);
        })
            ->where('cycle_id', $request->session()->get('cycle_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('auditor.audits.index', compact('audits'));
    }

    public function store(Request $request)
    {
        $audit = Audit::create([
            'cycle_id' => $request->session()->get('cycle_id'),
            'jurusan_id' => auth()->user()->auditor->jurusan->id,
            'prodi_id' => auth()->user()->auditor->prodi->id,
            'auditor_1_id' => auth()->user()->auditor->id,
        ]);

        $standards = Standard::where('cycle_id', $request->session()->get('cycle_id'))->get();
        foreach ($standards as $value) {
            $audit->auditStandards()->create([
                'standard_id' => $value->id,
                'repairment_status' => RepairmentStatus::NOT,
            ]);
        }

        alert()->success('Berhasil', 'Audit berhasil ditambahkan');
        return redirect()->route('auditor.audits.index');
    }

    public function rtmIndex($id)
    {
        $auditorId = auth()->user()->auditor->id;
        $audit = Audit::where(function ($query) use ($auditorId) {
            $query->where('auditor_1_id', $auditorId)->orWhere('auditor_2_id', $auditorId)->orWhere('auditor_3_id', $auditorId);
        })->findOrFail($id);

        return view('auditor.rtm.index', compact('audit'));
    }

    public function rtmUpdate($id, Request $request)
    {
        $request->validate([
            'rtm' => 'required|date',
        ]);
        $auditorId = auth()->user()->auditor->id;
        $audit = Audit::where(function ($query) use ($auditorId) {
            $query->where('auditor_1_id', $auditorId)->orWhere('auditor_2_id', $auditorId)->orWhere('auditor_3_id', $auditorId);
        })->findOrFail($id);

        $audit->update([
            'rtm' => $request->rtm,
            'is_done' => true,
        ]);

        alert()->success('Berhasil', 'Berhasil menyimpan rtm');
        return redirect()->route('auditor.audits.index');
    }
}
