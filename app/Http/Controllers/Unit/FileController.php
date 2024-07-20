<?php

namespace App\Http\Controllers\Unit;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function create() 
    {
        return view('unit.files.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required',
            'attachment' => 'required|file|max:10000',
        ]);

        if (auth()->user()->role == UserRole::UNIT_JURUSAN)
            $jurusan = auth()->user()->jurusan;
        else 
            $jurusan = auth()->user()->prodi->jurusan;

        $validatedData['jurusan_id'] = $jurusan->id;
        $validatedData['cycle_id'] = $request->session()->get('cycle_id'); 
        $validatedData['type'] = 'Unit_Auditor'; 

        $fileName = time() . '_' . $request->attachment->getClientOriginalName();
        $request->attachment->storeAs('attachment', $fileName, 'public');

        $validatedData['attachment'] = $fileName;

        $file = File::create($validatedData);

        alert()->success('Berhasil', 'File berhasil ditambahkan');
        return redirect()->back();
    }
}
