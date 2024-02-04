<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Storage;

class Admin extends Controller
{
    public function form()
    {
        $dataMasyarakat = Masyarakat::all();
        $dataBarang = Barang::all();
        return view('pages.pengelola.admin.dashboard.index', ['dataBarang' => $dataBarang, 'dataMasyarakat' => $dataMasyarakat]);
    }

    //Function Sidebar Barang
    public function formbarang()
    {
        $dataBarang = Barang::all();
        return view('pages.pengelola.admin.barang.index', ['dataBarang' => $dataBarang]);
    }

    public function HapusData($id)
    {
        try {
            $item = Barang::findOrFail($id);
            $item->delete();

            return redirect()->route('admin-barang')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin-barang')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }


    public function TambahData(Request $request)
    {
        $newName = '';
        if ($request->file('gambar')) {
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('gambar')->storeAs('gambar', $newName);
        }
        $request['image'] = $newName;
        $dataBarang = Barang::create($request->all());

        return redirect()->route('admin-barang');
    }



    public function formEdit($id)
    {
        $dataBarang = Barang::all()->find($id);
        return view('pages.pengelola.admin.barang.edit', ['dataBarang' => $dataBarang]);
    }

    public function Update(Request $request, $id)
    {
        // Temukan data barang berdasarkan ID
        $dataBarang = Barang::find($id);

        // Perbarui data barang dengan nilai dari formulir
        $dataBarang->update($request->except('image'));

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($dataBarang->image) {
                Storage::disk('public')->delete($dataBarang->image);
            }

            // Simpan gambar baru ke penyimpanan dan dapatkan pathnya
            $path = $request->file('image')->store('assets/products', 'public');

            // Set path gambar baru ke dalam data barang
            $dataBarang->update(['image' => $path]);
        }

        // Redirect ke halaman admin-barang
        return redirect()->route('admin-barang');
    }





    public function formlaporan()
    {
        return view('admin.laporan');
    }





    public function formmasyarakat()
    {
        $dataMasyarakat = Masyarakat::all();
        return view('pages.pengelola.admin.masyarakat.index', ['dataMasyarakat' => $dataMasyarakat]);
    }

    public function TambahMasyarakat(Request $request)
    {
        $dataMasyarakat = $request->all();

        Masyarakat::create($dataMasyarakat);

        return redirect()->route('admin-masyarakat');
    }

    public function HapusMasyarakat($id)
    {
        try {
            $item = Masyarakat::findOrFail($id);
            $item->delete();

            return redirect()->route('admin-masyarakat')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin-masyarakat')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    public function formEditMasyarakat($id)
    {
        $dataMasyarakat = Masyarakat::all()->find($id);
        return view('pages.pengelola.admin.masyarakat.edit', ['dataMasyarakat' => $dataMasyarakat]);
    }

    public function UpdateMasyarakat(Request $request, $id)
    {
        // Temukan data masyarakat berdasarkan ID
        $dataMasyarakat = Masyarakat::find($id);

        // Perbarui data masyarakat dengan nilai dari formulir
        $dataMasyarakat->update($request->all());

        // Redirect ke halaman admin-masyarakat atau sesuai kebutuhan
        return redirect()->route('admin-masyarakat');
    }
}
