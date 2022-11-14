<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama_barang',
        'stock',
        'anggaran',
        'scan',
    ];

    public Function peminjam(){
        return $this->hasMany(Peminjam::class);
    }
}
