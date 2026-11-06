<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $kelas->update($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }
}
