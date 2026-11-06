<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jurusan = Jurusan::paginate(10);
        return view('jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_jurusan' => 'required|string|max:10|unique:jurusans,kode_jurusan',
            'nama_jurusan' => 'required|string|max:50|unique:jurusans,nama_jurusan',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'kode_jurusan.required' => 'Kode jurusan wajib diisi.',
            'kode_jurusan.unique' => 'Kode jurusan sudah terdaftar.',
            'kode_jurusan.max' => 'Maksimal 10 karakter.',
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.unique' => 'Nama jurusan sudah terdaftar.',
            'nama_jurusan.max' => 'Maksimal 50 karakter.'
        ]);

        Jurusan::create([
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'kode_jurusan' => 'required|string|max:10|unique:jurusans,kode_jurusan,' . $id,
            'nama_jurusan' => 'required|string|max:50|unique:jurusans,nama_jurusan,' . $id,
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'kode_jurusan.required' => 'Kode jurusan wajib diisi.',
            'kode_jurusan.unique' => 'Kode jurusan sudah terdaftar.',
            'kode_jurusan.max' => 'Maksimal 10 karakter.',
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.unique' => 'Nama jurusan sudah terdaftar.',
            'nama_jurusan.max' => 'Maksimal 50 karakter.'
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($validatedData);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
