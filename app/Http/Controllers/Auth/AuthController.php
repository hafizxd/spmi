<?php

namespace App\Http\Controllers\Auth;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Cycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember') ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();

            if (Auth::user()->role == UserRole::ADMIN) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('auth.cycles.index');
        }

        Alert::error('Failed', 'Username / Password Salah');
        return back();
    }

    public function cycleIndex()
    {
        $cycles = Cycle::orderBy('order_no')->get();

        return view('auth.cycles', compact('cycles'));
    }

    public function cycleStore(Request $request)
    {
        $request->validate([
            'cycle_id' => 'required|exists:cycles,id',
        ]);

        if (! auth()->check()) {
            $this->logout($request);
        }

        $cycle = Cycle::findOrFail($request->cycle_id);

        $request->session()->put('cycle_id', $cycle->id);

        $redirectRoute = '';
        switch (Auth::user()->role) {
            case UserRole::AUDITOR:
                $redirectRoute = 'auditor.dashboard';
                break;

            case UserRole::UNIT_JURUSAN:
            case UserRole::UNIT_PRODI:
                $redirectRoute = 'unit.dashboard';
                break;

            default:
                $redirectRoute = 'landing-page';
                break;
        }

        return redirect()->route($redirectRoute);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('cycle_id');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing-page');
    }
}
