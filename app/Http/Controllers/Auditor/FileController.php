<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function index() {
        $files = File::where('type', 'Unit_Auditor')
            ->where('jurusan_id', auth()->user()->auditor->jurusan_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('auditor.files.index', compact('files'));
    }
}
