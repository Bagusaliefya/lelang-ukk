<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\History;
use App\Models\Lelang;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;
use Barryvdh\DomPDF\Facade\Pdf;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Petugas extends Controller
{
    public function form()
    {
        $dataBarang = Barang::all();
        $dataLelang = Lelang::all();
        return view('pages.pengelola.petugas.dashboard.index', ['dataBarang' => $dataBarang, 'dataLelang' => $dataLelang]);
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

    public function formData(Request $request)
    {
        $sort_by = $request->input('sort_by', 'all');
        $barang = $request->input('barang');

        $dataUser = History::with(['lelang', 'barang', 'user'])
            ->whereHas('lelang', function ($query) {
                $query->where('status', 'dibuka');
            })
            ->when($sort_by == 'high', function ($query) {
                $query->orderBy('penawaran_harga', 'desc');
            })
            ->when($sort_by == 'low', function ($query) {
                $query->orderBy('penawaran_harga', 'asc');
            })
            ->where('id_barang', $request->barang)
            ->get();

        // Ambil satu data saja untuk setiap id_barang
        if ($sort_by != 'all') {
            $dataUser = $dataUser->groupBy('lelang_id')->map(function ($group) {
                return $group->first();
            });
        }

        $dataLelang = Lelang::with(['history'])->where('status', 'dibuka')->get();

        return view('pages.pengelola.petugas.pemenang.data', [
            'dataUser' => $dataUser,
            'dataLelang' => $dataLelang,
            'sort_by' => $sort_by,
            'barang' => $barang,  // Mengirimkan variabel barang ke tampilan
        ]);
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


    public function exportPdf()
    {
        $dataLelang = Lelang::all();
        $pdf = Pdf::loadView('pages.pengelola.petugas.laporan.laporan', ['dataLelang' => $dataLelang]);
        return $pdf->download('export-lelang-.pdf');
    }
}
