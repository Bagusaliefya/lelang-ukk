<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    use HasFactory;
    protected $fillable = ['id_user', 'nama_lengkap', 'email', 'password', 'telp'];
    protected $primaryKey = 'id_user';
    protected $table = 'masyarakat';
}
