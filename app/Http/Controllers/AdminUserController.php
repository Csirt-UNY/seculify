<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        if ($user->save()) {
            return to_route('admin.users')->with('success', 'User berhasil ditambahkan.');
        } else {
            return to_route('admin.users')->with('error', 'Gagal menambahkan User.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required|in:admin,user,creator',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        if ($user->save()) {
            return to_route('admin.users')->with('success', 'User berhasil diperbarui.');
        } else {
            return to_route('admin.users')->with('error', 'Gagal memperbarui User.');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return to_route('admin.users')->with('success', 'User berhasil dihapus.');
        } else {
            return to_route('admin.users')->with('error', 'Gagal menghapus User.');
        }
    }
}
