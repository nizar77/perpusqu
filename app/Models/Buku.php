<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bukus';

    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'sinopsis',
        'cover',
        'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
