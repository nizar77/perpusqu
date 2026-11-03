  <aside :class="{
      'translate-x-0': sidebarOpen,
      '-translate-x-full lg:translate-x-0': !sidebarOpen,
      'lg:w-64': !sidebarCollapsed,
      'lg:w-20': sidebarCollapsed
    }"
        class="fixed left-0 top-0 h-full w-64 bg-surface-container-low z-50 flex flex-col justify-between shadow-xl lg:shadow-[0_1px_8px_rgba(0,0,0,0.04)] transition-all duration-300 ease-in-out border-r border-outline-variant/20 select-none">

        <div class="flex flex-col h-full overflow-y-auto">
            <!-- 1. HEADER BRANDING & LOGO -->
            <div
                class="h-16 px-space-md flex items-center justify-between bg-primary shrink-0 transition-all duration-300">
                <div class="flex items-center gap-space-sm overflow-hidden">
                    <div
                        class="w-8 h-8 rounded-lg bg-surface-container-lowest/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-on-primary text-[22px]">local_library</span>
                    </div>
                    <div class="flex flex-col whitespace-nowrap transition-opacity duration-300"
                        :class="{ 'lg:hidden': sidebarCollapsed }">
                        <span
                            class="font-headline-sm text-headline-sm text-on-primary leading-tight font-bold">EduLib</span>
                        <span
                            class="font-label-md text-[10px] text-on-primary-container tracking-wider uppercase font-semibold">SMA
                            Terpadu</span>
                    </div>
                </div>

                <!-- Mobile Close Button -->
                <button @click="sidebarOpen = false"
                    class="lg:hidden p-1.5 rounded-lg text-on-primary hover:bg-primary-container transition-colors"
                    title="Tutup Menu">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <!-- 2. SERVER STATUS MONITORING STRIP -->
            <div class="p-space-sm bg-surface-container shrink-0 transition-all duration-300"
                :class="{ 'lg:px-2': sidebarCollapsed }">
                <div class="flex items-center justify-between px-space-sm py-space-xs bg-surface rounded-lg border border-outline-variant/30"
                    :class="{ 'lg:justify-center lg:px-0': sidebarCollapsed }">
                    <div class="flex items-center gap-space-xs">
                        <span class="w-2.5 h-2.5 rounded-full bg-secondary-container animate-pulse shrink-0"></span>
                        <span class="font-label-md text-label-md text-on-surface whitespace-nowrap"
                            :class="{ 'lg:hidden': sidebarCollapsed }">Server Perpustakaan</span>
                    </div>
                    <span class="font-label-md text-[11px] text-secondary font-bold tracking-wide"
                        :class="{ 'lg:hidden': sidebarCollapsed }">ONLINE</span>
                </div>
            </div>

            <!-- 3. MAIN NAVIGATION MENU LINKS -->
            <nav class="flex flex-col gap-1 px-space-sm py-space-md flex-1">

                <!-- Link 1: Sirkulasi -->
                <a href="#"
                    class="group relative flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all font-label-lg text-label-lg"
                    :class="{ 'lg:justify-center lg:px-0': sidebarCollapsed }">
                    <span class="material-symbols-outlined shrink-0 text-[22px]">barcode_scanner</span>
                    <span class="whitespace-nowrap transition-opacity duration-300"
                        :class="{ 'lg:hidden': sidebarCollapsed }">Sirkulasi &amp; Scan</span>

                    <!-- Desktop Tooltip Mode Collapse -->
                    <div x-show="sidebarCollapsed"
                        class="hidden lg:block absolute left-full ml-3 px-3 py-1.5 bg-inverse-surface text-inverse-on-surface text-label-md rounded-md shadow-md opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 whitespace-nowrap">
                        Sirkulasi &amp; Scan Barcode
                    </div>
                </a>

                <!-- Link 2: Katalog (Active State) -->
                <a href="#" aria-current="page"
                    class="group relative flex items-center gap-space-sm px-space-md py-space-sm bg-primary-container text-on-primary font-bold rounded-lg shadow-sm transition-all font-label-lg text-label-lg"
                    :class="{ 'lg:justify-center lg:px-0': sidebarCollapsed }">
                    <span class="material-symbols-outlined shrink-0 text-[22px]">auto_stories</span>
                    <span class="whitespace-nowrap transition-opacity duration-300"
                        :class="{ 'lg:hidden': sidebarCollapsed }">Katalog &amp; Reservasi</span>

                    <div x-show="sidebarCollapsed"
                        class="hidden lg:block absolute left-full ml-3 px-3 py-1.5 bg-inverse-surface text-inverse-on-surface text-label-md rounded-md shadow-md opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 whitespace-nowrap">
                        Katalog &amp; Reservasi
                    </div>
                </a>

                <!-- Link 3: Denda -->
                <a href="#"
                    class="group relative flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all font-label-lg text-label-lg"
                    :class="{ 'lg:justify-center lg:px-0': sidebarCollapsed }">
                    <span class="material-symbols-outlined shrink-0 text-[22px]">payments</span>
                    <span class="whitespace-nowrap transition-opacity duration-300"
                        :class="{ 'lg:hidden': sidebarCollapsed }">Denda &amp; Pengembalian</span>

                    <div x-show="sidebarCollapsed"
                        class="hidden lg:block absolute left-full ml-3 px-3 py-1.5 bg-inverse-surface text-inverse-on-surface text-label-md rounded-md shadow-md opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 whitespace-nowrap">
                        Denda &amp; Pengembalian
                    </div>
                </a>

                <!-- Link 4: Data Siswa -->
                <a href="{{url('/data-siswa')}}"
                    class="group relative flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all font-label-lg text-label-lg"
                    :class="{ 'lg:justify-center lg:px-0': sidebarCollapsed }">
                    <span class="material-symbols-outlined shrink-0 text-[22px]">badge</span>
                    <span class="whitespace-nowrap transition-opacity duration-300"
                        :class="{ 'lg:hidden': sidebarCollapsed }">Data Siswa</span>

                    <div x-show="sidebarCollapsed"
                        class="hidden lg:block absolute left-full ml-3 px-3 py-1.5 bg-inverse-surface text-inverse-on-surface text-label-md rounded-md shadow-md opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 whitespace-nowrap">
                        Data Siswa
                    </div>
                </a>

                <!-- Link 5: Statistik Kunjungan -->
                <a href="#"
                    class="group relative flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all font-label-lg text-label-lg"
                    :class="{ 'lg:justify-center lg:px-0': sidebarCollapsed }">
                    <span class="material-symbols-outlined shrink-0 text-[22px]">query_stats</span>
                    <span class="whitespace-nowrap transition-opacity duration-300"
                        :class="{ 'lg:hidden': sidebarCollapsed }">Statistik Kunjungan</span>

                    <div x-show="sidebarCollapsed"
                        class="hidden lg:block absolute left-full ml-3 px-3 py-1.5 bg-inverse-surface text-inverse-on-surface text-label-md rounded-md shadow-md opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 whitespace-nowrap">
                        Statistik Kunjungan
                    </div>
                </a>

                 <a href="#"
                    class="group relative flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all font-label-lg text-label-lg"
                    :class="{ 'lg:justify-center lg:px-0': sidebarCollapsed }">
                    <span class="material-symbols-outlined shrink-0 text-[22px]">query_stats</span>
                    <span class="whitespace-nowrap transition-opacity duration-300"
                        :class="{ 'lg:hidden': sidebarCollapsed }">Kategori</span>

                    <div x-show="sidebarCollapsed"
                        class="hidden lg:block absolute left-full ml-3 px-3 py-1.5 bg-inverse-surface text-inverse-on-surface text-label-md rounded-md shadow-md opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 whitespace-nowrap">
                        Kategori
                    </div>
                </a>

                <!-- Link 6: Laporan Sistem -->
                <a href="#"
                    class="group relative flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all font-label-lg text-label-lg"
                    :class="{ 'lg:justify-center lg:px-0': sidebarCollapsed }">
                    <span class="material-symbols-outlined shrink-0 text-[22px]">assessment</span>
                    <span class="whitespace-nowrap transition-opacity duration-300"
                        :class="{ 'lg:hidden': sidebarCollapsed }">Laporan Sistem</span>

                    <div x-show="sidebarCollapsed"
                        class="hidden lg:block absolute left-full ml-3 px-3 py-1.5 bg-inverse-surface text-inverse-on-surface text-label-md rounded-md shadow-md opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 whitespace-nowrap">
                        Laporan Sistem
                    </div>
                </a>
            </nav>

            <!-- 4. FOOTER INTEGRATION CARD & DESKTOP COLLAPSE TOGGLE -->
            <div class="p-space-md bg-surface-container-low shrink-0 border-t border-outline-variant/10">
                <!-- Dapodik Widget Card -->
                <div class="p-space-sm rounded-xl bg-surface-container flex flex-col gap-space-xs transition-all"
                    :class="{ 'lg:p-2 lg:items-center': sidebarCollapsed }">
                    <div class="flex items-center gap-space-xs" :class="{ 'lg:justify-center': sidebarCollapsed }">
                        <span class="material-symbols-outlined text-secondary text-[20px] shrink-0">lan</span>
                        <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider"
                            :class="{ 'lg:hidden': sidebarCollapsed }">DAPODIK INTEGRASI</span>
                    </div>
                    <div class="flex items-center justify-between text-on-surface"
                        :class="{ 'lg:hidden': sidebarCollapsed }">
                        <span class="font-body-sm text-[12px] text-on-surface-variant">Sinkronisasi</span>
                        <span class="font-code-barcode text-code-barcode text-secondary text-[12px] font-semibold">10:42
                            WIB</span>
                    </div>
                </div>

                <!-- Desktop Collapse Button Toggle -->
                <button @click="sidebarCollapsed = !sidebarCollapsed"
                    class="hidden lg:flex w-full items-center justify-center gap-2 mt-3 py-2 px-3 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface-variant transition-colors"
                    title="Minimize/Expand Sidebar">
                    <span class="material-symbols-outlined transition-transform duration-300"
                        :class="{ 'rotate-180': sidebarCollapsed }">chevron_left</span>
                    <span class="font-label-md text-label-md"
                        x-text="sidebarCollapsed ? '' : 'Kecilkan Sidebar'"></span>
                </button>
            </div>
        </div>
    </aside>