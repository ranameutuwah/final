<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//import
use Illuminate\Database\Eloquent\Casts\Attribute;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'judul_buku',
        'pengarang_id',
        'tahun_terbit',
    ];
    //relasi tabel
    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'pengarang_id');
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class);
    }


}
