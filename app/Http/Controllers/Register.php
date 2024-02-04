<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Register extends Controller
{
    public function form()
    {
        return view('pages.auth.register');
    }

    public function tambahPetugas()
    {
    }
}
