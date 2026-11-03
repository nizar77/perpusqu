<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nip', 30)->unique()->nullable();
            $table->string('jabatan', 50)->default('Pustakawan'); // Contoh: Kepala Perpustakaan, Staf Administrasi
            $table->string('no_hp', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
