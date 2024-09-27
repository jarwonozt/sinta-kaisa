<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOut extends Model
{
    use HasFactory;
    protected $table = 'product_outs';
    protected $fillable = [
        'kode_pegawai',
        'kode_barang',
        'merk_barang',
        'ukuran',
        'jumlah_barang',
        'harga_satuan',
        'total_harga',
        'tanggal_keluar',
        'keterangan'
    ];
}
