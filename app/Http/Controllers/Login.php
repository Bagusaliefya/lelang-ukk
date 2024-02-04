<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends Controller
{
    public function form()
    {

        return view('pages.auth.login');
    }

    public function proses(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check the user's role_id and redirect accordingly
            $user = auth()->user();
            if ($user->role_id === 1) {
                return redirect()->intended('/Admin');
            } elseif ($user->role_id === 2) {
                return redirect()->intended('/Petugas');
            } elseif ($user->role_id === 3) {
                return redirect()->intended('/Masyarakat');
            }
        }

        return redirect()->route('login')->with('error', 'Invalid login credentials.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->regenerate();


        return redirect()->route('login');
    }
}
