@extends('layouts.app1')

@section('content')
<div class="p-6 lg:p-8 space-y-6" x-data="bukuCrud()">
    
    <!-- Header & Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold font-headline-lg text-on-surface">
                {{ isset($isTrash) && $isTrash ? 'Tempat Sampah Buku' : 'Katalog Buku Perpustakaan' }}
            </h1>
            <p class="text-sm text-on-surface-variant font-body-md">Kelola inventaris buku, cover, dan pemulihan data perpustakaan.</p>
        </div>
        <div class="flex items-center gap-2 justify-end">
            @if(isset($isTrash) && $isTrash)
                <a href="{{ route('buku.index') }}" 
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-surface-container text-on-surface font-medium rounded-lg hover:bg-surface-container-high transition shadow-sm text-sm">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    <span>Kembali ke Katalog</span>
                </a>
            @else
                <a href="{{ route('buku.index', ['trash' => 1]) }}" 
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-surface-container text-on-surface font-medium rounded-lg hover:bg-surface-container-high transition shadow-sm text-sm">
                    <span class="material-symbols-outlined text-sm">delete</span>
                    <span>Tempat Sampah</span>
                </a>
                <button @click="openCreateModal()" 
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-on-primary font-medium rounded-lg hover:bg-primary-container transition shadow-sm text-sm ">
                    <span class="material-symbols-outlined text-sm">add</span>
                    <span>Tambah Buku</span>
                </button>
            @endif
        </div>
    </div>

    <!-- Alert Success -->

    <!-- Tabel Data Buku -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-outline-variant/20 bg-surface-container-low text-xs font-semibold text-on-surface-variant uppercase tracking-wider">
                        <th class="py-3.5 px-6">Cover</th>
                        <th class="py-3.5 px-6">Judul & Penulis</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Stok</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10 text-sm text-on-surface font-body-md">
                    @forelse($bukus as $item)
                        <tr class="hover:bg-surface-container-low/50 transition align-top">
                            <td class="py-4 px-6 w-20">
                                @if($item->cover)
                                    <img src="{{ asset('storage/' . $item->cover) }}" alt="Cover" class="w-12 h-16 object-cover rounded shadow-sm border border-outline-variant/20">
                                @else
                                    <div class="w-12 h-16 bg-surface-container flex items-center justify-center text-xs text-on-surface-variant rounded border border-outline-variant/20">No Img</div>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-on-surface">{{ $item->judul }}</div>
                                <div class="text-xs text-on-surface-variant mt-0.5">Oleh: {{ $item->penulis }} ({{ $item->tahun_terbit ?? '-' }})</div>
                                <div class="text-xs text-on-surface-variant mt-2 line-clamp-2 max-w-md">
                                    <strong>Sinopsis:</strong> {{ $item->sinopsis ?: 'Tidak ada sinopsis.' }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 text-xs font-medium bg-secondary-fixed/30 text-on-secondary-fixed rounded-full">
                                    {{ $item->kategori->kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-semibold">{{ $item->stok }} eks</td>
                            <td class="py-4 px-6 text-center">
                                <div class="inline-flex items-center gap-1.5">
                                    @if(isset($isTrash) && $isTrash)
                                        <a href="{{ route('buku.restore', $item->id) }}" 
                                            class="px-2.5 py-1 text-xs font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition">Restore</a>
                                        <form action="{{ route('buku.force-delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 text-xs font-medium text-error bg-error-container hover:bg-error/20 rounded-lg transition">Hapus Permanen</button>
                                        </form>
                                    @else
                                        <button @click="openEditModal({{ json_encode($item) }})" 
                                            class="p-1.5 rounded-lg text-secondary hover:bg-secondary/10 transition" title="Edit">
                                            <span class="material-symbols-outlined text-base">edit</span>
                                        </button>
                                        <button @click="openDeleteModal({{ json_encode($item) }})" 
                                            class="p-1.5 rounded-lg text-error hover:bg-error/10 transition" title="Hapus">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-on-surface-variant">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($bukus->hasPages())
            <div class="p-4 border-t border-outline-variant/20">
                {{ $bukus->links() }}
            </div>
        @endif
    </div>

    <!-- MODAL TAMBAH & EDIT -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto bg-on-surface/35 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
        <div @click.outside="closeModal()" class="bg-surface-container-lowest w-full max-w-xl rounded-2xl shadow-xl overflow-hidden border border-outline-variant/20 p-6 space-y-6 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold font-headline-md text-on-surface" x-text="isEditMode ? 'Edit Data Buku' : 'Tambah Buku Baru'"></h3>
                <button @click="closeModal()" class="text-on-surface-variant hover:text-on-surface">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="text-sm text-on-surface-variant font-body-md">Isi data buku dengan lengkap dan benar. Pastikan cover buku berupa file gambar (jpg, png, dll).

            <form :action="isEditMode ? '/buku/' + form.id : '/buku'" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <template x-if="isEditMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Judul Buku</label>
                        <input type="text" name="judul" x-model="form.judul" required maxlength="255"
                            class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary text-sm bg-surface outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Kategori</label>
                        <select name="kategori_id" x-model="form.kategori_id" required
                            class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary text-sm bg-surface outline-none">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Penulis</label>
                        <input type="text" name="penulis" x-model="form.penulis" required maxlength="100"
                            class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary text-sm bg-surface outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Penerbit</label>
                        <input type="text" name="penerbit" x-model="form.penerbit" maxlength="100"
                            class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary text-sm bg-surface outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Tahun Terbit & Stok</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="tahun_terbit" x-model="form.tahun_terbit" placeholder="Tahun"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary text-sm bg-surface outline-none">
                            <input type="number" name="stok" x-model="form.stok" placeholder="Stok" min="0" required
                                class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary text-sm bg-surface outline-none">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Cover Buku (Gambar)</label>
                        <input type="file" name="cover" accept="image/*" class="w-full text-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Sinopsis</label>
                        <textarea name="sinopsis" x-model="form.sinopsis" rows="3"
                            class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary text-sm bg-surface outline-none"></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/20">
                    <button type="button" @click="closeModal()" class="px-4 py-2 text-sm text-on-surface-variant bg-surface-container rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-on-primary bg-primary rounded-lg" x-text="isEditMode ? 'Perbarui' : 'Simpan'"></button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto bg-on-surface/50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
        <div @click.outside="closeDeleteModal()" class="bg-surface-container-lowest w-full max-w-sm rounded-2xl shadow-xl p-6 space-y-6 text-center">
            <h3 class="text-lg font-bold text-on-surface">Hapus Buku?</h3>
            <p class="text-sm text-on-surface-variant">Pindahkan <strong x-text="deleteForm.judul"></strong> ke tempat sampah?</p>
            <form :action="'/buku/' + deleteForm.id" method="POST" class="flex items-center justify-center gap-3">
                @csrf @method('DELETE')
                <button type="button" @click="closeDeleteModal()" class="w-full px-4 py-2.5 text-sm bg-surface-container rounded-lg">Batal</button>
                <button type="submit" class="w-full px-4 py-2.5 text-sm text-on-error bg-error rounded-lg">Ya, Hapus</button>
            </form>
        </div>
    </div>

</div>

<script>
    function bukuCrud() {
        return {
            showModal: false,
            showDeleteModal: false,
            isEditMode: false,
            form: { id: null, kategori_id: '', judul: '', penulis: '', penerbit: '', tahun_terbit: '', sinopsis: '', stok: 0 },
            deleteForm: { id: null, judul: '' },
            openCreateModal() {
                this.isEditMode = false;
                this.form = { id: null, kategori_id: '', judul: '', penulis: '', penerbit: '', tahun_terbit: '', sinopsis: '', stok: 0 };
                this.showModal = true;
            },
            openEditModal(item) {
                this.isEditMode = true;
                this.form = { id: item.id, kategori_id: item.kategori_id, judul: item.judul, penulis: item.penulis, penerbit: item.penerbit, tahun_terbit: item.tahun_terbit, sinopsis: item.sinopsis, stok: item.stok };
                this.showModal = true;
            },
            closeModal() { this.showModal = false; },
            openDeleteModal(item) {
                this.deleteForm = { id: item.id, judul: item.judul };
                this.showDeleteModal = true;
            },
            closeDeleteModal() { this.showDeleteModal = false; }
        }
    }
</script>
@endsection