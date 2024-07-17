<?php

namespace App\Http\Controllers\Admin\Users;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    private $bladePrefix = 'admin.users.admins.';

    public function index()
    {
        $users = User::where('role', UserRole::ADMIN)->paginate(10);

        return view($this->bladePrefix . 'index', compact('users'));
    }

    public function create()
    {
        return view($this->bladePrefix . 'create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nidn' => 'nullable',
            'jabatan' => 'nullable',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ]);

        $password = Hash::make($request->password);

        $existsUser = User::where('email', $request->email)
            ->where('role', UserRole::ADMIN)
            ->exists();
        if ($existsUser) {
            alert()->error('Gagal', 'Sudah terdapat user '.UserRole::label(UserRole::ADMIN). ' dengan email tersebut');
            return redirect()->back();
        }


        $user = User::create([
            'name' => $request->name,
            'nidn' => $request->nidn,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => $password,
            'role' => UserRole::ADMIN
        ]);

        alert()->success('Berhasil', 'Admin berhasil ditambahkan');
        return redirect()->route('admin.users.admins.index');
    }

    public function show(string $id)
    {
        $user = User::where('role', UserRole::ADMIN)->findOrFail($id);

        return view($this->bladePrefix . 'detail', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::where('role', UserRole::ADMIN)->findOrFail($id);

        return view($this->bladePrefix . 'edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::where('role', UserRole::ADMIN)->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'nidn' => 'nullable',
            'jabatan' => 'nullable',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)->where(fn (\Illuminate\Database\Query\Builder $query) => $query->where('role', UserRole::ADMIN))],
        ]);

        $user->update([
            'name' => $request->name,
            'nidn' => $request->nidn,
            'jabatan' => $request->jabatan,
            'email' => $request->email
        ]);

        alert()->success('Berhasil', 'Admin berhasil diedit');
        return redirect()->route('admin.users.admins.index');
    }

    public function destroy(string $id)
    {
        User::where('role', UserRole::ADMIN)->findOrFail($id)->delete();

        alert()->success('Berhasil', 'Admin berhasil dihapus');
        return redirect()->route('admin.users.admins.index');
    }
}
