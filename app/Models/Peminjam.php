<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'nama_barang',
        'dokumentasi',
        'jumlah',
    ];

    public function barang(){
        return $this->hasMany(Barang::class);
    }
}
