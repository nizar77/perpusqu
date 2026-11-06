<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>EduLib — Sistem Otomasi Perpustakaan Sekolah</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500&amp;family=Plus+Jakarta+Sans:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script id="tailwind-config">
        tailwind.config={darkMode:"class",theme:{extend:{colors:{"on-tertiary":"#ffffff","surface":"#faf8ff","primary-container":"#1e3e62","tertiary-fixed":"#ffddb8","outline":"#73777f","on-secondary":"#ffffff","on-background":"#131b2e","background":"#faf8ff","on-primary-container":"#8ba9d3","on-surface-variant":"#43474e","on-tertiary-fixed":"#2a1700","primary-fixed":"#d3e4ff","primary-fixed-dim":"#aac9f4","surface-dim":"#d2d9f4","surface-bright":"#faf8ff","on-tertiary-container":"#e89500","on-primary":"#ffffff","secondary-fixed":"#c9e6ff","tertiary-container":"#573500","surface-container-highest":"#dae2fd","surface-container-high":"#e2e7ff","on-primary-fixed-variant":"#29486d","on-error":"#ffffff","error":"#ba1a1a","inverse-primary":"#aac9f4","error-container":"#ffdad6","on-tertiary-fixed-variant":"#653e00","surface-tint":"#426086","tertiary-fixed-dim":"#ffb95f","on-secondary-fixed-variant":"#004c6e","surface-container-lowest":"#ffffff","on-secondary-fixed":"#001e2f","on-error-container":"#93000a","secondary-container":"#39b8fd","on-secondary-container":"#004666","primary":"#01284b","surface-container":"#eaedff","inverse-surface":"#283044","tertiary":"#3a2100"},borderRadius:{DEFAULT:"0.25rem",lg:"0.5rem",xl:"0.75rem",full:"9999px"}}}}
    </script>
</head>
<body class="bg-background font-sans text-on-background min-h-screen flex flex-col justify-between selection:bg-primary-fixed selection:text-on-primary-fixed relative" x-data="{ role: 'siswa', showPassword: false }">
    <div class="absolute inset-0 pointer-events-none opacity-[0.035] bg-[radial-gradient(#01284b_1px,transparent_1px)] [background-size:24px_24px]"></div>
    
    <header class="w-full z-20 py-4 px-6 md:px-12 bg-surface/80 backdrop-blur-xl shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-on-primary shadow-sm">
                    <span class="material-symbols-outlined text-[24px]">menu_book</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-lg text-primary tracking-tight leading-tight">EduLib</span>
                    <span class="text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Perpustakaan SMK Texmaco</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-1.5 py-1 px-3 rounded-full bg-surface-container-high text-on-surface-variant text-xs font-semibold">
                    <span class="material-symbols-outlined text-[16px] text-secondary">verified_user</span>
                    <span>Database Terintegrasi</span>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 w-full flex items-center justify-center px-4 md:px-12 py-8 relative z-10">
        <div class="flex flex-col w-full max-w-6xl mx-auto my-auto py-4">
            <div class="relative w-full rounded-2xl overflow-hidden shadow-xl bg-surface-container-lowest border border-outline-variant/30">
                <div class="grid grid-cols-1 lg:grid-cols-12 min-h-[620px]">
                    
                    <!-- SISI KIRI: Visual Showcase & Informasi Akademik -->
                    <div class="lg:col-span-5 bg-primary text-on-primary p-8 lg:p-10 flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-secondary-container/10 blur-3xl pointer-events-none"></div>
                        <div class="absolute -bottom-20 -right-20 w-72 h-72 rounded-full bg-on-primary-container/15 blur-2xl pointer-events-none"></div>
                        
                        <div class="relative z-10">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-container/60 backdrop-blur-md mb-6">
                                <span class="w-2 h-2 rounded-full bg-secondary-container animate-pulse"></span>
                                <span class="text-xs font-semibold text-secondary-fixed tracking-wide">Multi-Role Auth Aktif</span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-xs uppercase tracking-widest text-on-primary-container font-bold">SMK Texmaco Semarang</span>
                                <h1 class="text-2xl lg:text-3xl font-extrabold text-on-primary tracking-tight">Portal Akses Pustaka Digital</h1>
                            </div>
                            <p class="text-sm text-primary-fixed-dim mt-3 leading-relaxed">
                                Sistem manajemen peminjaman buku terintegrasi berbasis relasi tabel Siswa, Karyawan, dan Admin dengan antarmuka reaktif Alpine.js.
                            </p>
                        </div>

                        <div class="relative z-10 my-6">
                            <div class="relative rounded-xl overflow-hidden shadow-md group border border-white/10">
                                <img class="w-full h-40 object-cover object-center transform group-hover:scale-105 transition-transform duration-500" 
                                     src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=800&q=80" 
                                     alt="Library Reading Room">
                                <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/40 to-transparent"></div>
                                <div class="absolute bottom-3 left-3 right-3 text-left">
                                    <span class="text-[10px] text-secondary-fixed bg-primary-container/80 px-2 py-0.5 rounded backdrop-blur-sm font-semibold">Kutipan Literasi</span>
                                    <p class="text-xs text-on-primary italic font-medium mt-1 leading-snug">
                                        "Membaca adalah pemeliharaan jiwa dan jendela ilmu pengetahuan."
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="relative z-10 pt-2 flex flex-col gap-3">
                            <div class="flex items-center justify-between p-3 rounded-lg bg-primary-container/40 backdrop-blur-sm border border-white/5">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-secondary-fixed text-[20px]">schedule</span>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-primary-fixed">Jam Layanan Sirkulasi</span>
                                        <span class="text-xs font-bold text-on-primary">Senin – Jumat • 07.15 – 15.30 WIB</span>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 text-xs font-bold">Buka</span>
                            </div>
                        </div>
                    </div>

                    <!-- SISI KANAN: Form Login Interaktif -->
                    <div class="lg:col-span-7 p-8 lg:p-10 flex flex-col justify-between bg-surface-container-lowest">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h2 class="text-xl font-bold text-on-surface">Masuk ke Sistem</h2>
                                    <p class="text-xs text-on-surface-variant">Gunakan akun terdaftar Anda untuk mengakses katalog buku.</p>
                                </div>
                                <div class="p-2.5 rounded-xl bg-surface-container hidden sm:flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[24px]">lock_person</span>
                                </div>
                            </div>

                            <!-- Role Toggle Switcher menggunakan Alpine.js -->
                            <div class="p-1.5 rounded-xl bg-surface-container flex items-center gap-1 mb-6">
                                <button type="button" 
                                        @click="role = 'siswa'" 
                                        :class="role === 'siswa' ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                                        class="flex-1 py-2 px-3 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[16px]">school</span>
                                    Siswa (NISN)
                                </button>
                                <button type="button" 
                                        @click="role = 'karyawan'" 
                                        :class="role === 'karyawan' ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                                        class="flex-1 py-2 px-3 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[16px]">badge</span>
                                    Karyawan / Guru
                                </button>
                                <button type="button" 
                                        @click="role = 'admin'" 
                                        :class="role === 'admin' ? 'bg-primary text-on-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                                        class="flex-1 py-2 px-3 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[16px]">admin_panel_settings</span>
                                    Admin
                                </button>
                            </div>

                            <!-- FORM LOGIN UTAMA -->
                            <form action="/login" method="POST" class="flex flex-col gap-4">
                                <!-- CSRF Token Laravel (Jika di Blade) -->
                                <!-- @csrf -->

                                <!-- Input Berdasarkan Role -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1.5" x-text="role === 'siswa' ? 'Nomor Induk Siswa Nasional (NISN)' : (role === 'karyawan' ? 'Nomor Induk Pegawai (NIP) / Email' : 'Username / Email Administrator')"></label>
                                        <div class="relative flex items-center">
                                            <span class="absolute left-3 text-on-surface-variant material-symbols-outlined text-[18px]">account_circle</span>
                                            <input type="text" 
                                                   name="login_identifier" 
                                                   required 
                                                   :placeholder="role === 'siswa' ? 'Contoh: 0071239845' : (role === 'karyawan' ? 'Contoh: 198204122008011005' : 'admin_perpus')"
                                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-surface-container-low text-xs text-on-surface border border-outline-variant/30 focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary transition-all font-mono"/>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label class="text-xs font-semibold text-on-surface">Kata Sandi (Password)</label>
                                            <button type="button" @click="showPassword = !showPassword" class="text-xs text-secondary hover:underline flex items-center gap-1 font-semibold">
                                                <span class="material-symbols-outlined text-[14px]" x-text="showPassword ? 'visibility_off' : 'visibility'"></span>
                                                <span x-text="showPassword ? 'Sembunyikan' : 'Lihat'"></span>
                                            </button>
                                        </div>
                                        <div class="relative flex items-center">
                                            <span class="absolute left-3 text-on-surface-variant material-symbols-outlined text-[18px]">key</span>
                                            <input :type="showPassword ? 'text' : 'password'" 
                                                   name="password" 
                                                   required 
                                                   placeholder="••••••••" 
                                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-surface-container-low text-xs text-on-surface border border-outline-variant/30 focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary transition-all"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-xs pt-1">
                                    <label class="flex items-center gap-2 cursor-pointer select-none text-on-surface-variant">
                                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-primary focus:ring-primary accent-primary"/>
                                        <span>Ingat saya di perangkat ini</span>
                                    </label>
                                    <a href="#" class="text-secondary hover:underline font-semibold">Lupa Sandi?</a>
                                </div>

                                <button type="submit" class="w-full mt-2 py-3 px-4 rounded-xl bg-primary text-on-primary text-xs font-bold hover:bg-primary-container active:scale-[0.99] transition-all flex items-center justify-center gap-2 shadow-sm">
                                    <span class="material-symbols-outlined text-[18px]">login</span>
                                    <span x-text="'Masuk ke Dashboard ' + (role.charAt(0).toUpperCase() + role.slice(1))"></span>
                                </button>
                            </form>
                        </div>

                        <!-- Footer Registrasi Bawah -->
                        <div class="mt-6 pt-4 border-t border-outline-variant/20 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <div class="text-xs text-on-surface-variant flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px] text-primary">info</span>
                                <span>Belum memiliki akun terdaftar?</span>
                            </div>
                            <a href="/register" class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-primary text-xs font-bold transition-colors">
                                Registrasi Akun Baru
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="w-full z-20 py-4 px-6 md:px-12 bg-surface-container-lowest/80 backdrop-blur-md border-t border-outline-variant/20">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left text-xs text-on-surface-variant">
            <p>© 2026 EduLib • Sistem Informasi Perpustakaan SMK Texmaco Semarang.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-primary transition-colors">Bantuan Sistem</a>
                <span>•</span>
                <a href="#" class="hover:text-primary transition-colors">Dokumentasi API</a>
            </div>
        </div>
    </footer>
</body>
</html>