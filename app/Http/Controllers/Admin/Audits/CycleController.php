<?php

namespace App\Http\Controllers\Admin\Audits;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    private $bladePrefix = 'admin.audits.cycles.';

    public function index()
    {
        $cycles = Cycle::paginate(10);

        return view($this->bladePrefix . 'index', compact('cycles'));
    }

    public function create()
    {
        return view($this->bladePrefix . 'create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|between:1940,9999',
        ]);

        $orderNo = 1;
        $latestCycle = Cycle::orderBy('order_no', 'desc')->first();        
        if (isset($latestCycle)) {
            $orderNo = $latestCycle->order_no + 1;
        }
        
        Cycle::create([
            'year' => $request->year,
            'order_no' => $orderNo
        ]);

        alert()->success('Berhasil', 'Siklus berhasil ditambahkan');
        return redirect()->route('admin.audits.cycles.index');
    }

    public function edit(string $id)
    {
        $cycle = Cycle::findOrFail($id);

        return view($this->bladePrefix . 'edit', compact('cycle'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'year' => 'required|numeric|between:1940,9999',
        ]);
        
        Cycle::findOrFail($id)->update([
            'year' => $request->year
        ]);

        alert()->success('Berhasil', 'Siklus berhasil diedit');
        return redirect()->route('admin.audits.cycles.index');
    }

    public function destroy(string $id)
    {
        Cycle::findOrFail($id)->delete()   ;

        alert()->success('Berhasil', 'Siklus berhasil dihapus');
        return redirect()->route('admin.audits.cycles.index');
    }
}
