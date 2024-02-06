<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    protected $table = 'lelang';

    protected $fillable = [
        'id_lelang',
        'id_barang',
        'tanggal_lelang',
        'harga_awal',
        'harga_akhir',
        'id_user',
        'status',
    ];

    protected $primaryKey = 'id_lelang';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function history()
    {
        return $this->hasMany(History::class, 'id_lelang', 'id_lelang');
    }
}
