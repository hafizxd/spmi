<?php

namespace App\Http\Controllers\Admin\Audits;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Models\Standard;
use Illuminate\Support\Facades\Storage;

class StandardController extends Controller
{
    private $bladePrefix = 'admin.audits.standards.';

    public function index()
    {
        $standards = Standard::paginate(10);

        return view($this->bladePrefix . 'index', compact('standards'));
    }

    public function create()
    {
        $cycles = Cycle::orderBy('order_no', 'asc')->get();
        $prodi = Prodi::orderBy('name_prodi')->get();

        return view($this->bladePrefix . 'create', compact('cycles', 'prodi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'prodi_id' => 'required|exists:prodi,id',
            'name' => 'required',
            'brief_content' => 'nullable',
            'content' => 'nullable',
            'attachment' => 'nullable|file|max:10000',
        ]);

        if ($request->hasFile('attachment')) {
            $fileName = time() . '_' . $request->attachment->getClientOriginalName();
            $request->attachment->storeAs('standards', $fileName, 'public');

            $validated['attachment'] = $fileName;
        }
        
        Standard::create($validated);

        alert()->success('Berhasil', 'Standar berhasil ditambahkan');
        return redirect()->route('admin.audits.standards.index');
    }

    public function edit(string $id)
    {
        $standard = Standard::findOrFail($id);
        $cycles = Cycle::orderBy('order_no', 'asc')->get();
        $prodi = Prodi::orderBy('name_prodi')->get();

        return view($this->bladePrefix . 'edit', compact('standard', 'cycles', 'prodi'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'name' => 'required',
            'brief_content' => 'nullable',
            'content' => 'nullable',
            'attachment' => 'nullable|file|max:10000',
        ]);

        $standard = Standard::findOrFail($id);

        if ($request->hasFile('attachment')) {
            if (Storage::disk('public')->exists('standards/' . $standard->attachment)) {
                Storage::disk('public')->delete('standards/' . $standard->attachment);
            }

            $fileName = time() . '_' . $request->attachment->getClientOriginalName();
            $request->attachment->storeAs('standards', $fileName, 'public');

            $validated['attachment'] = $fileName;
        } else {
            unset($validated['attachment']);
        }
        
        $standard->update($validated);

        alert()->success('Berhasil', 'Standar berhasil diedit');
        return redirect()->route('admin.audits.standards.index');
    }

    public function destroy(string $id)
    {
        $standard = Standard::findOrFail($id);

        if (Storage::disk('public')->exists('standards/' . $standard->attachment)) {
            Storage::disk('public')->delete('standards/' . $standard->attachment);
        }

        $standard->delete();

        alert()->success('Berhasil', 'Standar berhasil dihapus');
        return redirect()->route('admin.audits.standards.index');
    }
}
