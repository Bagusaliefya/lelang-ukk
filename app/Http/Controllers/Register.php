<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Register extends Controller
{
    public function form()
    {
        return view('pages.auth.register');
    }

    public function tambahPetugas(Request $request)
    {
        $dataPetugas = $request->all();

        User::create($dataPetugas);

        return redirect()->route('login')->with('success', 'Data Berhasil Didaftarkan');
    }
}
