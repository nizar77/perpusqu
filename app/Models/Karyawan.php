<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $fillable = ['user_id', 'nip', 'nama_lengkap', 'jabatan', 'no_hp'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
