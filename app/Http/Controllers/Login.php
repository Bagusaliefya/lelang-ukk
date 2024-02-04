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
            if ($user->role_id === 1) { // assuming 1 is the role_id for admin
                return redirect()->intended('/Admin');
            } elseif ($user->role_id === 2) { // assuming 2 is the role_id for petugas
                return redirect()->intended('/Petugas');
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
