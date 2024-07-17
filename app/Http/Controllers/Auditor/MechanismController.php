<?php

namespace App\Http\Controllers\Auditor;

use App\Models\Audit;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MechanismController extends Controller
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
        $mechanisms = $audit->mechanisms()->get();

        return view('auditor.mechanisms.index', compact('audit', 'mechanisms'));
    }

    public function store($id, Request $request)
    {
        $request->validate(['name' => 'required']);

        $audit = $this->findAudit($id);
        $audit->mechanisms()->create([
            'name' => $request->name,
            'is_yes' => false,
        ]);

        alert()->success('Berhasil', 'Berhasil menambahkan mekanisme');
        return redirect()->back();
    }

    public function save($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'answers' => 'array|min:1',
        ]);
        if ($validator->fails()) {
            alert()->error('Gagal', 'Silahkan isi minimal 1 mekanisme');
            return redirect()->back();
        }

        $audit = $this->findAudit($id);

        foreach ($request->answers as $key => $value) {
            $audit->mechanisms()->where('id', $key)->update(['is_yes' => $value]);
        }

        $audit->update(['is_mechanism' => true]);

        alert()->success('Berhasil', 'Berhasil mengisi data mekanisme');
        return redirect()->route('auditor.audits.index');
    }

    public function destroy($id, $mechanismId)
    {
        $audit = $this->findAudit($id);
        $audit->mechanisms()->findOrFail($mechanismId)->delete();

        alert()->success('Berhasil', 'Berhasil menghapus mekanisme');
        return redirect()->back();
    }
}
