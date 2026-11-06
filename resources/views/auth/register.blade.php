<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Perpustakaan Digital</title>
    <!-- Tailwind CSS v4 CDN / Vite Build -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-slate-800 p-8 rounded-2xl shadow-xl border border-slate-700"
         x-data="{ role: '{{ old('role', 'siswa') }}' }">
        
        <div>
            <h2 class="text-center text-3xl font-extrabold text-white">Pendaftaran Akun</h2>
            <p class="mt-2 text-center text-sm text-slate-400">Sistem Informasi Perpustakaan Sekolah</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded-lg text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('register.post') }}" method="POST">
            @csrf

            <!-- Pilihan Role (Reaktif dengan Alpine.js) -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Daftar Sebagai</label>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" 
                            @click="role = 'siswa'"
                            :class="role === 'siswa' ? 'bg-indigo-600 border-indigo-500 text-white' : 'bg-slate-700 border-slate-600 text-slate-300'"
                            class="py-2 px-4 border rounded-xl text-sm font-semibold transition focus:outline-none">
                        Siswa
                    </button>
                    <button type="button" 
                            @click="role = 'karyawan'"
                            :class="role === 'karyawan' ? 'bg-indigo-600 border-indigo-500 text-white' : 'bg-slate-700 border-slate-600 text-slate-300'"
                            class="py-2 px-4 border rounded-xl text-sm font-semibold transition focus:outline-none">
                        Karyawan / Guru
                    </button>
                </div>
                <input type="hidden" name="role" x-model="role">
            </div>

            <!-- Data Umum Akun -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required 
                           class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300">Email Sekolah</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required 
                           class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <!-- Bagian Khusus Siswa (Muncul Reaktif) -->
                <div x-show="role === 'siswa'" x-transition class="space-y-4 border-t border-slate-700 pt-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300">NISN</label>
                        <input type="text" name="nisn" value="{{ old('nisn') }}" :required="role === 'siswa'"
                               class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XI TKJ 1" :required="role === 'siswa'"
                               class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <!-- Bagian Khusus Karyawan (Muncul Reaktif) -->
                <div x-show="role === 'karyawan'" x-transition class="space-y-4 border-t border-slate-700 pt-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300">NIP / NUPTK (Opsional)</label>
                        <input type="text" name="nip" value="{{ old('nip') }}"
                               class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300">Jabatan</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Guru Produktif / Staff Perpus" :required="role === 'karyawan'"
                               class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300">Nomor HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" 
                           class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300">Password</label>
                    <input type="password" name="password" required 
                           class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required 
                           class="mt-1 block w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Daftar Sekarang
                </button>
            </div>
            
            <div class="text-center text-sm text-slate-400">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Masuk disini</a>
            </div>
        </form>
    </div>
</body>
</html>