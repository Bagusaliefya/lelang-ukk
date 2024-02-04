<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Lelang;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Petugas extends Controller
{
    public function form()
    {
        $dataBarang = Barang::all();
        return view('pages.pengelola.petugas.dashboard.index', ['dataBarang' => $dataBarang]);
    }

    //Function Sidebar Barang
    public function formbarang()
    {
        $dataBarang = Barang::all();
        return view('pages.pengelola.petugas.barang.index', ['dataBarang' => $dataBarang]);
    }

    public function formlelang()
    {
        $dataLelang = Barang::all();
        // dd($dataLelang);


        return view('pages.pengelola.petugas.lelang.index', ['dataLelang' => $dataLelang]);
    }

    public function TambahLelang(Request $request)
    {
        $dataLelang = $request->all();

        Lelang::create($dataLelang);

        return redirect()->route('petugas-lelang');
    }
}
