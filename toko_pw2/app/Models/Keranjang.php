<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_user',
        'nama_barang',
        'jumlah',
        'total_harga',
        'barang_id',
    ];
}
