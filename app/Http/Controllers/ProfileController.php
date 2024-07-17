<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profiles.index');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)->where(fn (\Illuminate\Database\Query\Builder $query) => $query->where('role', auth()->user()->role))],
            'photo' => 'nullable|image',
        ]);

        if ($request->hasFile('photo')) {
            if (Storage::disk('public')->exists('photo/' . auth()->user()->photo)) {
                Storage::disk('public')->delete('photo/' . auth()->user()->photo);
            }

            $fileName = time() . '_' . $request->photo->getClientOriginalName();
            $request->photo->storeAs('photo', $fileName, 'public');
            $validatedData['photo'] = $fileName;
        } else {
            unset($validatedData['photo']);
        }

        auth()->user()->update($validatedData);

        alert()->success('Berhasil', 'Berhasil mengubah data profile');
        return redirect()->back();
    }

    public function passwordIndex()
    {
        return view('profiles.password');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ]);

        $checked = Hash::check($request->old_password, auth()->user()->password);
        if (!$checked) {
            alert()->error('Gagal', 'Password lama anda salah');
            return redirect()->back();
        }

        $password = Hash::make($request->password);
        auth()->user()->update([
            'password' => $password
        ]);

        alert()->success('Berhasil', 'Berhasil reset password');
        return redirect()->back();
    }
}
