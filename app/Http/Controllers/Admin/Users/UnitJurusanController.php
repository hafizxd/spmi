<?php

namespace App\Http\Controllers\Admin\Users;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UnitJurusanController extends Controller
{
    private $bladePrefix = 'admin.users.unit-jurusan.';

    public function index()
    {
        $users = User::has('jurusan')->paginate(10);

        return view($this->bladePrefix . 'index', compact('users'));
    }

    public function create()
    {
        return view($this->bladePrefix . 'create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_jurusan' => 'required',
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
            'role' => UserRole::UNIT_JURUSAN
        ]);

        $user->jurusan()->create([
            'name_jurusan' => $request->name_jurusan,
        ]);

        alert()->success('Berhasil', 'Unit Jurusan berhasil ditambahkan');
        return redirect()->route('admin.users.unit-jurusan.index');
    }

    public function show(string $id)
    {
        $user = User::where('role', UserRole::UNIT_JURUSAN)
            ->with('jurusan.prodi.user')
            ->findOrFail($id);

        return view($this->bladePrefix . 'detail', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::where('role', UserRole::UNIT_JURUSAN)->findOrFail($id);

        return view($this->bladePrefix . 'edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::where('role', UserRole::UNIT_JURUSAN)->findOrFail($id);

        $request->validate([
            'name_jurusan' => 'required',
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

        $user->jurusan()->update([
            'name_jurusan' => $request->name_jurusan,
        ]);

        alert()->success('Berhasil', 'Unit Jurusan berhasil diedit');
        return redirect()->route('admin.users.unit-jurusan.index');
    }

    public function destroy(string $id)
    {
        User::where('role', UserRole::UNIT_JURUSAN)->findOrFail($id)->delete();

        alert()->success('Berhasil', 'Unit Jurusan berhasil dihapus');
        return redirect()->route('admin.users.unit-jurusan.index');
    }
}
