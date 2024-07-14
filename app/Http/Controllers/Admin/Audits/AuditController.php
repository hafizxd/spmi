<?php

namespace App\Http\Controllers\Admin\Audits;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\Cycle;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index() {
        $audits = Audit::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.audits.audits.index', compact('audits'));
    }

    public function create()
    {
        $cycles = Cycle::orderBy('order_no')->get();
        $jurusan = Jurusan::orderBy('name_jurusan')->get();

        return view('admin.audits.audits.create', compact('cycles', 'jurusan'));
    }    

    public function store(Request $request) {
        $validatedData = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'prodi_id' => 'required|exists:prodi,id',
            'auditor_1_id' => 'required|exists:users,id',
            'auditor_2_id' => 'required|exists:users,id',
            'auditor_3_id' => 'required|exists:users,id',
        ]);

        Audit::create($validatedData);

        alert()->success('Berhasil', 'Audit berhasil ditambahkan');
        return redirect()->route('admin.audits.audits.index');
    }

    public function destroy(string $id)
    {
        Audit::findOrFail($id)->delete()   ;

        alert()->success('Berhasil', 'Audit berhasil dihapus');
        return redirect()->route('admin.audits.audits.index');
    }
}
