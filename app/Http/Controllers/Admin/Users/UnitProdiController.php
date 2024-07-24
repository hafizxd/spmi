<?php

namespace App\Http\Controllers\Admin\Users;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Validation\Rule;

class UnitProdiController extends Controller
{
    private $bladePrefix = 'admin.users.unit-prodi.';

    public function create($jurusanId)
    {
        $userJurusan = User::findOrFail($jurusanId);

        return view($this->bladePrefix . 'create', compact('userJurusan'));
    }

    public function store($jurusanId, Request $request)
    {
        $userJurusan = User::findOrFail($jurusanId);

        $request->validate([
            'name_prodi' => 'required',
            'jenjang' => 'required|in:Diploma,Sarjana,Magister,Non Jenjang',
            'name' => 'required',
            'nidn' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ]);

        $existsUser = User::where('email', $request->email)
            ->where('role', UserRole::UNIT_PRODI)
            ->exists();
        if ($existsUser) {
            alert()->error('Gagal', 'Sudah terdapat user '.UserRole::label(UserRole::UNIT_PRODI). ' dengan email tersebut');
            return redirect()->back();
        }

        $password = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'nidn' => $request->nidn,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $password,
            'role' => UserRole::UNIT_PRODI,
        ]);

        $user->prodi()->create([
            'jurusan_id' => $userJurusan->jurusan->id,
            'name_prodi' => $request->name_prodi,
            'jenjang' => $request->jenjang,
        ]);

        alert()->success('Berhasil', 'Unit Prodi berhasil ditambahkan');
        return redirect()->route('admin.users.unit-jurusan.show', $userJurusan->id);
    }

    public function show(string $jurusanId, $prodiId)
    {
        $user = User::where('role', UserRole::UNIT_PRODI)
            ->whereHas('prodi', function ($query) use ($jurusanId) {
                $query->whereRelation('jurusan', 'user_id', $jurusanId);
            })
            ->findOrFail($prodiId);

        return view($this->bladePrefix . 'detail', compact('user'));
    }

    public function edit(string $jurusanId, $prodiId)
    {
        $user = User::where('role', UserRole::UNIT_PRODI)
            ->whereHas('prodi', function ($query) use ($jurusanId) {
                $query->whereRelation('jurusan', 'user_id', $jurusanId);
            })
            ->findOrFail($prodiId);

        return view($this->bladePrefix . 'edit', compact('user'));
    }

    public function update(Request $request, string $jurusanId, $prodiId)
    {
        $user = User::where('role', UserRole::UNIT_PRODI)
            ->whereHas('prodi', function ($query) use ($jurusanId) {
                $query->whereRelation('jurusan', 'user_id', $jurusanId);
            })
            ->findOrFail($prodiId);

        $request->validate([
            'name_prodi' => 'required',
            'jenjang' => 'required|in:Diploma,Sarjana,Magister,Non Jenjang',
            'name' => 'required',
            'nidn' => 'nullable',
            'phone' => 'nullable',
            'email' => ['required', 'email', Rule::unique('users')->ignore($prodiId)->where(fn (\Illuminate\Database\Query\Builder $query) => $query->where('role', UserRole::UNIT_PRODI))],
        ]);

        $user->update([
            'name' => $request->name,
            'nidn' => $request->nidn,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $user->prodi()->update([
            'name_prodi' => $request->name_prodi,
            'jenjang' => $request->jenjang,
        ]);

        alert()->success('Berhasil', 'Unit prodi berhasil diedit');
        return redirect()->route('admin.users.unit-jurusan.show', $jurusanId);
    }

    public function destroy(string $jurusanId, $prodiId)
    {
        User::where('role', UserRole::UNIT_PRODI)
            ->whereHas('prodi', function ($query) use ($jurusanId) {
                $query->whereRelation('jurusan', 'user_id', $jurusanId);
            })
            ->findOrFail($prodiId)
            ->delete();

        alert()->success('Berhasil', 'Unit prodi berhasil dihapus');
        return redirect()->route('admin.users.unit-jurusan.show', $jurusanId);
    }
}
