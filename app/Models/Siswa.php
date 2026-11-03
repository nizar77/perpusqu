<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Siswa extends Model
{
    protected $fillable = ['user_id', 'nisn', 'nama_lengkap', 'kelas_id', 'no_hp', 'alamat'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
