<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (auth()->user()->role == 'user') {
            return to_route('user');
        } else {
            return to_route('admin');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $isGoogle = User::where('email', $input['email'])->first();

        if ($isGoogle->account_type == 'google') {
            return to_route('login')->with('warning', 'Akun ini terdaftar dengan Google. Silakan login dengan Google.');
        }

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            if (auth()->user()->role == 'user') {
                return to_route('user');
            } else {
                return to_route('admin');
            }
        } else {
            return to_route('login')->with('error', 'Email atau password salah')->withInput();
        }
    }
}
