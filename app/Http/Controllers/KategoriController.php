<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:50|unique:kategoris,kategori',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'kategori.required' => 'Nama kategori wajib diisi.',
            'kategori.unique' => 'Nama kategori sudah terdaftar.',
            'kategori.max' => 'Maksimal 50 karakter.'
        ]);

        Kategori::create([
            'kategori' => $request->kategori,
            'slug_Kategori' => Str::slug($request->kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'kategori' => 'required|string|max:50|unique:kategoris,kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $kategori->update([
            'kategori' => $request->kategori,
            'slug_Kategori' => Str::slug($request->kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
