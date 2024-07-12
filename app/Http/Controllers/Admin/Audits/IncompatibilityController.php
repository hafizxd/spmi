<?php

namespace App\Http\Controllers\Admin\Audits;

use App\Http\Controllers\Controller;
use App\Models\Incompatibility;
use Illuminate\Http\Request;

class IncompatibilityController extends Controller
{
    private $bladePrefix = 'admin.audits.incompatibilities.';

    public function index()
    {
        $incompatibilities = Incompatibility::paginate(10);

        return view($this->bladePrefix . 'index', compact('incompatibilities'));
    }

    public function create()
    {
        return view($this->bladePrefix . 'create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        Incompatibility::create([
            'name' => $request->name,
        ]);

        alert()->success('Berhasil', 'Ketidaksesuaian berhasil ditambahkan');
        return redirect()->route('admin.audits.incompatibilities.index');
    }

    public function edit(string $id)
    {
        $incompatibility = Incompatibility::findOrFail($id);

        return view($this->bladePrefix . 'edit', compact('incompatibility'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        Incompatibility::findOrFail($id)->update([
            'name' => $request->name
        ]);

        alert()->success('Berhasil', 'Ketidaksesuaian berhasil diedit');
        return redirect()->route('admin.audits.incompatibilities.index');
    }

    public function destroy(string $id)
    {
        Incompatibility::findOrFail($id)->delete();

        alert()->success('Berhasil', 'Ketidaksesuaian berhasil dihapus');
        return redirect()->route('admin.audits.incompatibilities.index');
    }
}
