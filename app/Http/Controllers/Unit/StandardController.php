<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{
    public function index(Request $request) 
    {
        $standards = Standard::where('prodi_id', auth()->user()->prodi->id)
            ->where('cycle_id', $request->session()->get('cycle_id'))
            ->paginate(10);

        return view('unit.standards.index', compact('standards'));
    }
}
