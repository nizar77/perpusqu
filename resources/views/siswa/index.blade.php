@extends('layouts.app1')
    @section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Siswa</h1>
        {{-- <a href="{{ route('siswa.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Siswa</a> --}}
    </div>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">NIS</th>
                <th class="py-2 px-4 border-b">Kelas</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            data kosong
        </tbody>
    </table>
    @endsection


  