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
        $dataLelang = Lelang::with(['barang', 'user'])->get();
        $dataBarang = Barang::all();
        // dd($dataLelang);


        return view('pages.pengelola.petugas.lelang.index', ['dataLelang' => $dataLelang, 'dataBarang' => $dataBarang],);
    }

    public function TambahLelang(Request $request)
    {
        $hargaAwal = Barang::find($request->id_barang)->harga_awal;

        Lelang::create([
            'id_lelang' => $request->id_lelang,
            'id_barang' => $request->id_barang,
            'tanggal_lelang' => $request->tanggal_lelang,
            'harga_awal' => $hargaAwal,
            'harga_akhir' => 0,
            'status' => 'dibuka',

        ]);

        return redirect()->route('petugas-lelang');
    }
    public function HapusLelang($id)
    {
        try {
            $item = Lelang::findOrFail($id);
            $item->delete();

            return redirect()->route('petugas-lelang')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('petugas-lelang')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }
}
