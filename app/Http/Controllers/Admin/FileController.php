<?php

namespace App\Http\Controllers\Admin;

use App\Constants\RepairmentStatus;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Cycle;
use App\Models\Jurusan;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index($type) {
        $files = File::where('type', $type)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.files.index', compact('files'));
    }

    public function create()
    {
        $cycles = Cycle::orderBy('order_no')->get();
        return view('admin.files.create', compact('cycles'));
    }    

    public function store($type, Request $request) {
        $validatedData = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'title' => 'required',
            'attachment' => 'required|file|max:10000',
        ]);

        $validatedData['type'] = ucfirst(strtolower($type)); 

        $fileName = time() . '_' . $request->attachment->getClientOriginalName();
        $request->attachment->storeAs('attachment', $fileName, 'public');

        $validatedData['attachment'] = $fileName;

        $file = File::create($validatedData);

        alert()->success('Berhasil', 'File berhasil ditambahkan');
        return redirect()->route('admin.files.index', $type);
    }

    public function edit($type, $file)
    {
        $cycles = Cycle::orderBy('order_no')->get();
        $file = File::where('type', $type)->findOrFail($file);

        return view('admin.files.edit', compact('file', 'cycles'));
    }    

    public function update($type, $file, Request $request) {
        $validatedData = $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
            'title' => 'required',
            'attachment' => 'nullable|file|max:10000',
        ]);

        $validatedData['type'] = ucfirst(strtolower($type)); 

        $file = File::where('type', $type)->findOrFail($file);

        if ($request->hasFile('attachment')) {
            if (Storage::disk('public')->exists('attachment/' . $file->attachment)) {
                Storage::disk('public')->delete('attachment/' . $file->attachment);
            }

            $fileName = time() . '_' . $request->attachment->getClientOriginalName();
            $request->attachment->storeAs('attachment', $fileName, 'public');
            $validatedData['attachment'] = $fileName;
        } else {
            unset($validatedData['attachment']);
        }

        $file->update($validatedData);

        alert()->success('Berhasil', 'File berhasil diubah');
        return redirect()->route('admin.files.index', $type);
    }

    public function destroy($type, $file)
    {
        File::where('type', $type)->findOrFail($file)->delete();

        alert()->success('Berhasil', 'File berhasil dihapus');
        return redirect()->route('admin.files.index', $type);
    }
}
