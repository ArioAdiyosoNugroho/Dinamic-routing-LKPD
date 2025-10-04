<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ];

        if ($request->role == 'user') {
            $rules['kelas'] = 'required|min:2';
            $rules['nis'] = [
                'required',
                'min:4',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('nis', '!=', null);
                })
            ];
        } else {
            $rules['kelas'] = 'nullable';
            $rules['nis'] = 'nullable';
        }

        $request->validate($rules, [
            'nis.required' => 'NIS wajib diisi untuk role user',
            'nis.min' => 'NIS minimal harus 4 karakter',
            'nis.unique' => 'NIS sudah digunakan oleh user lain',
            'kelas.required' => 'Kelas wajib diisi untuk role user',
            'kelas.min' => 'Kelas minimal harus 2 karakter',
        ]);

        $userData = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        if ($request->role == 'user') {
            $userData['kelas'] = $request->kelas;
            $userData['nis'] = $request->nis;
        }

        User::create($userData);

        return redirect()->back()->with('success', 'User berhasil dibuat');
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:6',
        ];

        if ($request->role == 'user') {
            $rules['kelas'] = 'required|min:2';
            $rules['nis'] = [
                'required',
                'min:4',
                Rule::unique('users')->ignore($user->id)->where(function ($query) {
                    return $query->where('nis', '!=', null);
                })
            ];
        } else {
            $rules['kelas'] = 'nullable';
            $rules['nis'] = 'nullable';
        }

        $request->validate($rules, [
            'nis.required' => 'NIS wajib diisi untuk role user',
            'nis.min' => 'NIS minimal harus 4 karakter',
            'nis.unique' => 'NIS sudah digunakan oleh user lain',
            'kelas.required' => 'Kelas wajib diisi untuk role user',
            'kelas.min' => 'Kelas minimal harus 2 karakter',
        ]);

        $data = [
            'name' => $request->name,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->role == 'user') {
            $data['kelas'] = $request->kelas;
            $data['nis'] = $request->nis;
        } else {
            $data['kelas'] = null;
            $data['nis'] = null;
        }

        $user->update($data);

        return redirect()->back()->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
