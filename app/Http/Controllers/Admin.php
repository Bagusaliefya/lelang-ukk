<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Admin extends Controller
{
    public function form()
    {
        $dataMasyarakat = User::where('role_id', 3)->get();
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

        return redirect()->route('admin-barang')->with('success', 'Data berhasil ditambahkan!');
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
        return redirect()->route('admin-barang')->with('success', 'Data berhasil diubah!');
    }

    public function exportPdf()
    {
        $dataBarang = Barang::all();
        $pdf = Pdf::loadView('pages.pengelola.admin.laporan.laporan', ['dataBarang' => $dataBarang]);
        return $pdf->download('export-barang-.pdf');
    }





    public function formlaporan()
    {
        return view('admin.laporan');
    }





    public function formmasyarakat()
    {
        $dataMasyarakat = User::where('role_id', 3)->get();
        $roles = Role::all();
        return view('pages.pengelola.admin.masyarakat.index', ['dataMasyarakat' => $dataMasyarakat], ['roles' => $roles]);
    }

    public function TambahMasyarakat(Request $request)
    {
        $dataMasyarakat = $request->all();

        // Menambahkan role_id ke data sebelum disimpan
        $dataMasyarakat['role_id'] = 3;

        User::create($dataMasyarakat);

        return redirect()->route('admin-masyarakat')->with('success', 'Data berhasil Ditambahkan!');
    }

    public function HapusMasyarakat($id)
    {
        try {
            $item = User::findOrFail($id);
            $item->delete();

            return redirect()->route('admin-masyarakat')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin-masyarakat')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    public function formEditMasyarakat($id)
    {
        $dataMasyarakat = User::all()->find($id);
        return view('pages.pengelola.admin.masyarakat.edit', ['dataMasyarakat' => $dataMasyarakat]);
    }

    public function UpdateMasyarakat(Request $request, $id)
    {
        // Temukan data masyarakat berdasarkan ID
        $dataMasyarakat = User::find($id);

        // Perbarui data masyarakat dengan nilai dari formulir
        $dataMasyarakat->update($request->all());

        // Redirect ke halaman admin-masyarakat atau sesuai kebutuhan
        return redirect()->route('admin-masyarakat')->with('success', 'Data berhasil diubah!');
    }
}
