<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['id_barang', 'nama_barang', 'tanggal', 'harga_awal', 'deskripsi_barang', 'image'];
    protected $primaryKey = 'id_barang';
    protected $table = 'barang';

    public function lelang()
    {
        return $this->hasMany(Lelang::class, 'id_barang', 'id_barang');
    }
}
