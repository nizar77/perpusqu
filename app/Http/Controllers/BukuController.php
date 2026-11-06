<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('trash')) {
            $bukus = Buku::onlyTrashed()->with('kategori')->latest()->paginate(10);
            $isTrash = true;
        } else {
            $bukus = Buku::with('kategori')->latest()->paginate(10);
            $isTrash = false;
        }

        $kategoris = Kategori::all();
        return view('buku.index', compact('bukus', 'kategoris', 'isTrash'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|digits:4',
            'sinopsis' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'stok' => 'required|integer|min:0',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Buku::create([
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'sinopsis' => $request->sinopsis,
            'cover' => $coverPath,
            'stok' => $request->stok,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|digits:4',
            'sinopsis' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'stok' => 'required|integer|min:0',
        ]);

        $coverPath = $buku->cover;
        if ($request->hasFile('cover')) {
            if ($coverPath && Storage::disk('public')->exists($coverPath)) {
                Storage::disk('public')->delete($coverPath);
            }
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        $buku->update([
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'sinopsis' => $request->sinopsis,
            'cover' => $coverPath,
            'stok' => $request->stok,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku dipindahkan ke tempat sampah.');
    }

    public function restore($id)
    {
        $buku = Buku::onlyTrashed()->findOrFail($id);
        $buku->restore();

        return redirect()->route('buku.index', ['trash' => 1])->with('success', 'Buku berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $buku = Buku::onlyTrashed()->findOrFail($id);
        if ($buku->cover && Storage::disk('public')->exists($buku->cover)) {
            Storage::disk('public')->delete($buku->cover);
        }
        $buku->forceDelete();

        return redirect()->route('buku.index', ['trash' => 1])->with('success', 'Buku dihapus permanen.');
    }
}
