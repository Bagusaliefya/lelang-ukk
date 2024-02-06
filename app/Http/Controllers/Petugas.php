<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\History;
use App\Models\Lelang;
use PhpParser\Node\Stmt\Return_;
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


        return view('pages.pengelola.petugas.lelang.index', ['dataLelang' => $dataLelang, 'dataBarang' => $dataBarang]);
    }

    public function formPemenang()
    {
        $dataPemenangLelang = Lelang::with(['history', 'barang'])->get();

        return view('pages.pengelola.petugas.pemenang.index', ['dataPemenang' => $dataPemenangLelang]);
    }

    public function formData()
    {
        $dataUser = History::with(['lelang', 'barang', 'user'])->get();
        $dataLelang = Lelang::with(['history'])->get();
        // dd($dataUser);
        return view('pages.pengelola.petugas.pemenang.data', ['dataUser' => $dataUser, 'dataLelang' => $dataLelang]);
    }


    public function UpdateLelang(Request $request, $id)
    {
        // Temukan data lelang berdasarkan ID
        $lelang = Lelang::findOrFail($id);
        $penawaranTertinggi = History::where('id_lelang', $lelang->id_lelang)->max('penawaran_harga');
        $idUser = History::where([['id_lelang', $lelang->id_lelang], ['penawaran_harga', $penawaranTertinggi]])->first();
        // Perbarui harga_akhir, pemenang, dan status pada data lelang

        $lelang->update([
            'harga_akhir' => $penawaranTertinggi,
            'id_user' => $idUser->id_user,
            'status' => 'Ditutup' // Atur status menjadi Ditutup
        ]);


        // Redirect ke halaman petugas lelang atau sesuai kebutuhan
        return redirect()->route('petugas-lelang');
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
