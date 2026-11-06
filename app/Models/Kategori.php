<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    protected $fillable = ['nama_kategori', 'slug_kategori', 'deskripsi'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            $kategori->slug_kategori = Str::slug($kategori->kategori);
        });
        static::updating(function ($kategori) {
            $kategori->slug_kategori = Str::slug($kategori->kategori);
        });
    }
}
