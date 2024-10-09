<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Po_Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang', 'satuan', 'jumlah', 'harga_satuan', 'keterangan'
    ];
}
