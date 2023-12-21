<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_peminjam',
        'buku_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class,'buku_id');
    }
}
