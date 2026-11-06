
@extends('layouts.app1')

@section('content')
<div class="p-6 lg:p-8 space-y-6" x-data="jurusanCrud()">
    
    <!-- Header & Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold font-headline-lg text-on-surface">Kelola Jurusan</h1>
            <p class="text-sm text-on-surface-variant font-body-md">Tambah, ubah, dan hapus jurusan di perpustakaan.</p>
        </div>
        <button @click="openCreateModal()" 
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-on-primary font-medium rounded-lg hover:bg-primary-container transition shadow-sm">
            <span class="material-symbols-outlined text-sm">add</span>
            <span>Tambah Jurusan</span>
        </button>
    </div>

  

    <!-- Tabel Data jurusan -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-outline-variant/20 bg-surface-container-low text-xs font-semibold text-on-surface-variant uppercase tracking-wider">
                        <th class="py-3.5 px-6">No</th>
                        <th class="py-3.5 px-6">Kode Jurusan</th>
                        <th class="py-3.5 px-6">Nama Jurusan</th>
                        <th class="py-3.5 px-6">Deskripsi</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10 text-sm text-on-surface font-body-md">
                    @forelse($jurusan as $index => $item)
                        <tr class="hover:bg-surface-container-low/50 transition">
                            <td class="py-4 px-6 font-medium">{{ $jurusan->firstItem() + $index }}</td>
                            <td class="py-4 px-6 font-semibold">{{ $item->kode_jurusan }}</td>
                            <td class="py-4 px-6 font-code-barcode text-xs text-on-surface-variant">{{ $item->nama_jurusan }}</td>
                            <td class="py-4 px-6 text-on-surface-variant">{{ $item->deskripsi ?? '-' }}</td>
                            <td class="py-4 px-6 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <!-- Edit Button -->
                                    <button @click="openEditModal({{ json_encode($item) }})" 
                                        class="p-1.5 rounded-lg text-secondary hover:bg-secondary/10 transition" title="Edit">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                    </button>
                                    <!-- Delete Button -->
                                    <button @click="openDeleteModal({{ json_encode($item) }})" 
                                        class="p-1.5 rounded-lg text-error hover:bg-error/10 transition" title="Hapus">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-on-surface-variant">Belum ada data jurusan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($jurusan->hasPages())
            <div class="p-4 border-t border-outline-variant/20">
                {{ $jurusan->links() }}
            </div>
        @endif
    </div>

    <!-- ==================== MODAL TAMBAH & EDIT (Reusable State) ==================== -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto bg-on-surface/50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
        <div @click.outside="closeModal()" class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-xl overflow-hidden border border-outline-variant/20 p-6 space-y-6">
            
            <div class="flex items-center justify-end gap-4">
                <h3 class="text-lg font-bold font-headline-md text-on-surface" x-text="isEditMode ? 'Edit jurusan' : 'Tambah jurusan Baru'"></h3>
                <button @click="closeModal()" class="text-on-surface-variant hover:text-on-surface">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form :action="isEditMode ? '/jurusan/' + form.id : '/jurusan'" method="POST" class="space-y-4">
                @csrf
                <template x-if="isEditMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                 <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Kode jurusan</label>
                    <input type="text" name="kode_jurusan" x-model="form.kode_jurusan" required maxlength="10"
                        class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary text-sm bg-surface outline-none transition"
                        placeholder="Contoh: TEI, RPL">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Nama jurusan</label>
                    <input type="text" name="nama_jurusan" x-model="form.nama_jurusan" required maxlength="50"
                        class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary text-sm bg-surface outline-none transition"
                        placeholder="Contoh: Elektronik industri, Rekayasa perangkat lunak ...">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" x-model="form.deskripsi" rows="3" maxlength="255"
                        class="w-full px-3.5 py-2.5 rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary text-sm bg-surface outline-none transition"
                        placeholder="Keterangan singkat jurusan..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/20">
                    <button type="button" @click="closeModal()" 
                        class="px-4 py-2 text-sm font-medium text-on-surface-variant bg-surface-container hover:bg-surface-container-high rounded-lg transition">
                        Batal
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-on-primary bg-primary hover:bg-primary-container rounded-lg transition shadow-sm"
                        x-text="isEditMode ? 'Perbarui' : 'Simpan'">
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL KONFIRMASI HAPUS ==================== -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto bg-on-surface/50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
        <div @click.outside="closeDeleteModal()" class="bg-surface-container-lowest w-full max-w-sm rounded-2xl shadow-xl overflow-hidden border border-outline-variant/20 p-6 space-y-6 text-center">
            
            <div class="w-12 h-12 rounded-full bg-error-container text-error flex items-center justify-center mx-auto">
                <span class="material-symbols-outlined text-2xl">warning</span>
            </div>

            <div class="space-y-2">
                <h3 class="text-lg font-bold font-headline-md text-on-surface">Hapus jurusan?</h3>
                <p class="text-sm text-on-surface-variant font-body-md">
                    Apakah Anda yakin ingin menghapus jurusan <strong class="text-on-surface" x-text="deleteForm.jurusan"></strong>? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            <form :action="'/jurusan/' + deleteForm.id" method="POST" class="flex items-center justify-center gap-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="closeDeleteModal()" 
                    class="w-full px-4 py-2.5 text-sm font-medium text-on-surface-variant bg-surface-container hover:bg-surface-container-high rounded-lg transition">
                    Batal
                </button>
                <button type="submit" 
                    class="w-full px-4 py-2.5 text-sm font-medium text-on-error bg-error hover:bg-error/90 rounded-lg transition shadow-sm">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>

</div>

<!-- Alpine Script Component State -->
<script>
    function jurusanCrud() {
        return {
            showModal: false,
            showDeleteModal: false,
            isEditMode: false,
            form: { id: null, kode_jurusan: '', nama_jurusan: '', deskripsi: '' },
            deleteForm: { id: null, jurusan: '' },

            openCreateModal() {
                this.isEditMode = false;
                this.form = { id: null, kode_jurusan: '', nama_jurusan: '', deskripsi: '' };
                this.showModal = true;
            },

            openEditModal(item) {
                this.isEditMode = true;
                this.form = { id: item.id, kode_jurusan: item.kode_jurusan, nama_jurusan: item.nama_jurusan, deskripsi: item.deskripsi };
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            },

            openDeleteModal(item) {
                this.deleteForm = { id: item.id, jurusan: item.nama_jurusan };
                this.showDeleteModal = true;
            },

            closeDeleteModal() {
                this.showDeleteModal = false;
            }
        }
    }
</script>
@endsection