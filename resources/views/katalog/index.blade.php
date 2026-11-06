<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full text-slate-100" 
      x-data="{ 
          search: '', 
          selectedKategori: 'all',
          // Data buku dari backend di-pass ke Alpine lewat JSON
          bukus: {{ json_encode($bukus->items()) }} 
      }">
    
    <div class="min-h-full flex flex-col">
        <!-- Navbar -->
        <nav class="bg-slate-800 border-b border-slate-700 px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-400">Perpustakaan SMK - Katalog Buku</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-300">Halo, Pengguna</span>
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-lg text-xs font-semibold transition">Logout</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header & Filter Section -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
                <!-- Search Live with Alpine -->
                <div class="w-full md:w-1/3">
                    <input type="text" 
                           x-model="search" 
                           placeholder="Cari judul buku, penulis, atau penerbit..." 
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm">
                </div>

                <!-- Filter Kategori -->
                <div class="flex gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0">
                    <button @click="selectedKategori = 'all'"
                            :class="selectedKategori === 'all' ? 'bg-indigo-600 text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'"
                            class="px-4 py-2 rounded-xl text-xs font-semibold transition border border-slate-700">
                        Semua
                    </button>
                    @foreach($kategoris as $kat)
                        <button @click="selectedKategori = '{{ $kat->id }}'"
                                :class="selectedKategori == '{{ $kat->id }}' ? 'bg-indigo-600 text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'"
                                class="px-4 py-2 rounded-xl text-xs font-semibold transition border border-slate-700 whitespace-nowrap">
                            {{ $kat->nama_kategori }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Grid Katalog Buku (Reaktif dengan Alpine.js) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <template x-for="buku in bukus.filter(b => {
                    let matchSearch = b.judul.toLowerCase().includes(search.toLowerCase()) || 
                                      b.penulis.toLowerCase().includes(search.toLowerCase());
                    let matchKat = selectedKategori === 'all' || b.kategori_id == selectedKategori;
                    return matchSearch && matchKat;
                })" :key="buku.id">
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-lg flex flex-col justify-between transition hover:border-indigo-500">
                        <div class="p-5 flex-1">
                            <div class="flex justify-between items-start mb-3">
                                <span class="bg-indigo-500/10 text-indigo-400 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider" 
                                      x-text="buku.kategori ? buku.kategori.nama_kategori : 'Umum'"></span>
                                <span class="text-xs font-mono text-slate-400" x-text="'Stok: ' + buku.stok"></span>
                            </div>
                            <h3 class="font-bold text-lg text-white mb-1 line-clamp-2" x-text="buku.judul"></h3>
                            <p class="text-xs text-slate-400 mb-2">Penulis: <span class="text-slate-200" x-text="buku.penulis"></span></p>
                            <p class="text-xs text-slate-400">Penerbit: <span class="text-slate-200" x-text="buku.penerbit"></span> (<span x-text="buku.tahun_terbit"></span>)</p>
                        </div>
                        <div class="px-5 pb-5 pt-2 border-t border-slate-700/50 flex justify-between items-center">
                            <span class="text-xs font-mono text-slate-500" x-text="buku.kode_buku"></span>
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                Pinjam Buku
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Empty State jika buku tidak ditemukan -->
            <div class="text-center py-12" x-show="bukus.filter(b => b.judul.toLowerCase().includes(search.toLowerCase())).length === 0" style="display: none;">
                <p class="text-slate-400 text-sm">Buku yang kamu cari tidak ditemukan.</p>
            </div>

        </main>
    </div>
</body>
</html>