<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audit;

class ConclusionController extends Controller
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

        return view('auditor.conclusions.edit', compact('audit'));
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'is_document_complete' => 'required|boolean',
            'note' => 'nullable',
            'input_date' => 'nullable|date'
        ]);

        $audit = $this->findAudit($id);

        $audit->conclusion()->create($validatedData);
        $audit->update([ 'is_conclusion' => true ]);

        alert()->success('Berhasil', 'Berhasil menyimpan kesimpulan');
        return redirect()->route('auditor.audits.index');
    }
}
