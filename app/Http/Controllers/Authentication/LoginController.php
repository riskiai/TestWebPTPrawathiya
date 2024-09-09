<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Periksa apakah pengguna adalah admin
            if (Auth::user()->role_id == 1) {
                return redirect()->route('dashboard')->with('success', 'Berhasil Login'); 
            } else {
                Auth::logout(); // Logout jika bukan admin
                return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
            }
        }

        return redirect()->back()->with('error', 'Email atau kata sandi salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }
}
