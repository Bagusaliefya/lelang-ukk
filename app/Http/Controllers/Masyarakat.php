<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use App\Models\Barang;


class Masyarakat extends Controller
{
    public function form()
    {
        $dataLelang = Lelang::with(['history'])->where('status', 'dibuka')->get();
        return view('pages.pengelola.masyarakat.lelang.index', ['dataLelang' => $dataLelang]);
    }

    public function bid(Request $request)
    {
        $barang = Barang::find($request->id_barang);

        // Memeriksa apakah bid lebih rendah dari harga awal
        if ($request->penawaran_harga < $barang->harga_awal) {
            return redirect()->back()->with('error', 'Nominal bid tidak boleh kurang dari harga awal.');
        }

        // Jika bid valid, buat riwayat baru
        $history = History::create($request->all());
        return redirect()->route('masyarakat');
    }
}
