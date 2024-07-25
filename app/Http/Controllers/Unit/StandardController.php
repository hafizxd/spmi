<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StandardController extends Controller
{
    public function index(Request $request) 
    {
        $standards = Standard::where('prodi_id', auth()->user()->prodi->id)
            ->where('cycle_id', $request->session()->get('cycle_id'))
            ->paginate(10);

        return view('unit.standards.index', compact('standards'));
    }

    public function detail($id)
    {
        $standard = Standard::findOrFail($id);

        return view('unit.standards.detail', compact('standard'));
    }

    public function edit($id)
    {
        $standard = Standard::findOrFail($id);

        return view('unit.standards.edit', compact('standard'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'attachment' => 'required|file|max:10000',
        ]);

        $standard = Standard::findOrFail($id);

        if (Storage::disk('public')->exists('standards/' . $standard->attachment)) {
            Storage::disk('public')->delete('standards/' . $standard->attachment);
        }

        $fileName = time() . '_' . $request->attachment->getClientOriginalName();
        $request->attachment->storeAs('standards', $fileName, 'public');

        $standard->update([
            'attachment' => $fileName
        ]);

        alert()->success('Berhasil', 'Berhasil upload file');
        return redirect()->route('unit.standards.index');
    }
}
