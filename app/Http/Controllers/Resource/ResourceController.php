<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function getProdi(Request $request) {
        if (!isset($request->jurusan_id)) {
            return response()->json([
                'success' => false,
                'message' => 'jurusan id is required'
            ], 400);
        }

        $prodi = Prodi::where('jurusan_id', $request->jurusan_id)->orderBy('name_prodi', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'payload' => $prodi
        ]);
    }
}
