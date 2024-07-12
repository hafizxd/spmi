<?php

namespace App\Http\Controllers\Admin\Audits;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use Illuminate\Http\Request;
use App\Models\Standard;

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

        return view($this->bladePrefix . 'create', compact('cycles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'name' => 'required',
            'brief_content' => 'nullable',
            'content' => 'nullable'
        ]);
        
        Standard::create($validated);

        alert()->success('Berhasil', 'Standar berhasil ditambahkan');
        return redirect()->route('admin.audits.standards.index');
    }

    public function edit(string $id)
    {
        $standard = Standard::findOrFail($id);
        $cycles = Cycle::orderBy('order_no', 'asc')->get();

        return view($this->bladePrefix . 'edit', compact('standard', 'cycles'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'name' => 'required',
            'brief_content' => 'nullable',
            'content' => 'nullable'
        ]);
        
        Standard::findOrFail($id)->update($validated);

        alert()->success('Berhasil', 'Standar berhasil diedit');
        return redirect()->route('admin.audits.standards.index');
    }

    public function destroy(string $id)
    {
        Standard::findOrFail($id)->delete();

        alert()->success('Berhasil', 'Standar berhasil dihapus');
        return redirect()->route('admin.audits.standards.index');
    }
}
