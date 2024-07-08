<?php

namespace App\Http\Controllers\Admin\Users;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Validation\Rule;

class AuditorController extends Controller
{
    private $bladePrefix = 'admin.users.auditor.';

    public function index()
    {
        $users = User::has('auditor')->paginate(10);

        return view($this->bladePrefix . 'index', compact('users'));
    }

    public function create()
    {
        $jurusan = Jurusan::orderBy('name_jurusan')->get();

        return view($this->bladePrefix . 'create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'prodi_id' => 'required|exists:prodi,id',
            'name' => 'required',
            'nidn' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ]);

        $password = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'nidn' => $request->nidn,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $password,
            'role' => UserRole::AUDITOR
        ]);

        $user->auditor()->create([
            'jurusan_id' => $request->jurusan_id,
            'prodi_id' => $request->prodi_id,
        ]);

        alert()->success('Berhasil', 'Auditor berhasil ditambahkan');
        return redirect()->route('admin.users.auditors.index');
    }

    public function show(string $id)
    {
        $user = User::where('role', UserRole::AUDITOR)->findOrFail($id);

        return view($this->bladePrefix . 'detail', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::where('role', UserRole::AUDITOR)->findOrFail($id);
        $jurusan = Jurusan::orderBy('name_jurusan')->get();

        return view($this->bladePrefix . 'edit', compact('user', 'jurusan'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::where('role', UserRole::AUDITOR)->findOrFail($id);

        $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'prodi_id' => 'required|exists:prodi,id',
            'name' => 'required',
            'nidn' => 'nullable',
            'phone' => 'nullable',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
        ]);

        $user->update([
            'name' => $request->name,
            'nidn' => $request->nidn,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        $user->auditor()->update([
            'jurusan_id' => $request->jurusan_id,
            'prodi_id' => $request->prodi_id,
        ]);

        alert()->success('Berhasil', 'Auditor berhasil diedit');
        return redirect()->route('admin.users.auditors.index');
    }

    public function destroy(string $id)
    {
        User::where('role', UserRole::AUDITOR)->findOrFail($id)->delete();

        alert()->success('Berhasil', 'Auditor berhasil dihapus');
        return redirect()->route('admin.users.auditors.index');
    }
}
