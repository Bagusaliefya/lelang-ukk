<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Masyarakat extends Controller
{
    public function form()
    {

        return view('masyarakat.index');
    }
    public function formLogin()
    {

        return view('pages.auth.masyarakat.login');
    }
}
