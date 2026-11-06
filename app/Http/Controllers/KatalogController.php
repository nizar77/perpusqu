<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;


class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        // Fitur Filter Search sederhana di backend jika diperlukan, 
        // tapi kita juga bisa buat reaktif pakai Alpine.js di frontend!
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('penerbit', 'like', "%{$search}%");
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }

        $bukus = $query->latest()->paginate(12);
        $kategoris = Kategori::all();

        return view('katalog.index', compact('bukus', 'kategoris'));
    }
}
