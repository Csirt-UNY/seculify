<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $video = Config::where('key', 'tutorial_video')->first();
        return view('user.index', compact('video'));
    }

    public function profile()
    {
        return view('user.profile.index');
    }

    public function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'agency' => 'required|string|max:255|min:3',
            'sub_unit' => 'required|string|max:255|min:3',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->agency = $request->agency;
        $user->sub_unit = $request->sub_unit;
        if($user->save()) {
            return to_route('user.profile')->with('success', 'Profil berhasil diperbarui');
        } else {
            return to_route('user.profile')->with('error', 'Profil gagal diperbarui');
        }
    }

    public function firstProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'agency' => 'required|string|max:255|min:3',
            'sub_unit' => 'required|string|max:255|min:3',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->agency = $request->agency;
        $user->sub_unit = $request->sub_unit;
        if($user->save()) {
            return to_route('user')->with('success', 'Profil berhasil diperbarui');
        } else {
            return to_route('user.profile')->with('error', 'Profil gagal diperbarui');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        if (password_verify($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            if($user->save()) {
                return to_route('user.profile')->with('success', 'Password berhasil diperbarui');
            } else {
                return to_route('user.profile')->with('error', 'Password gagal diperbarui');
            }
        } else {
            return to_route('user.profile')->with('error', 'Password lama salah');
        }
    }
}
