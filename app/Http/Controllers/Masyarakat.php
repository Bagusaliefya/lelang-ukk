<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Masyarakat extends Controller
{
    public function form()
    {
        $dataLelang = Lelang::all();
        return view('pages.pengelola.masyarakat.lelang.index', ['dataLelang' => $dataLelang]);
    }
}
