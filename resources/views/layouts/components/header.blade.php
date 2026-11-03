 <header :class="{ 'lg:left-64': !sidebarCollapsed, 'lg:left-20': sidebarCollapsed }"
        class="fixed top-0 left-0 right-0 h-16 bg-primary z-30 flex items-center justify-between px-space-md lg:px-space-lg shadow-[0_1px_8px_rgba(0,0,0,0.04)] transition-all duration-300">

        <div class="flex items-center gap-space-sm lg:gap-space-md">
            <!-- Hamburger Toggle Button (Mobile Only) -->
            <button @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden p-2 rounded-lg text-on-primary hover:bg-primary-container transition-colors focus:outline-none"
                aria-label="Buka Menu Sidebar">
                <span class="material-symbols-outlined text-[24px]">menu</span>
            </button>

            <!-- Segmented Mode Controls -->
            <div class="flex items-center bg-primary-container p-1 rounded-full">
                <button
                    class="px-3 lg:px-space-md py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md transition-all shadow-sm font-semibold"
                    type="button">Mode Pustakawan</button>
                <button
                    class="px-3 lg:px-space-md py-1 rounded-full text-on-primary-container hover:text-on-primary font-label-md text-label-md transition-all"
                    type="button">Mode Siswa</button>
            </div>

            <!-- School Name Tag -->
            <div
                class="hidden xl:flex items-center gap-space-xs px-space-sm py-1 bg-surface-container-lowest/10 rounded-md">
                <span class="material-symbols-outlined text-secondary-fixed text-[18px]">verified</span>
                <span class="font-label-md text-label-md text-surface-container-low">SMA Negeri 1 Terpadu</span>
            </div>
        </div>

        <div class="flex items-center gap-space-sm lg:gap-space-md">
            <!-- Notifications Button -->
            <div class="relative flex items-center">
                <button class="relative p-2 rounded-full text-on-primary hover:bg-primary-container transition-colors"
                    title="Notifikasi Sirkulasi &amp; Denda" type="button">
                    <span class="material-symbols-outlined text-[22px]">notifications</span>
                    <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-error rounded-full ring-2 ring-primary"></span>
                </button>
            </div>

            <div class="h-6 w-px bg-on-primary-container/20"></div>

            <!-- User Profile Avatar & Name -->
            <div class="flex items-center gap-space-sm">
                <div class="text-right hidden sm:block">
                    <div class="font-label-lg text-label-lg text-on-primary leading-tight font-semibold">Siti Nurhaliza,
                        S.Ptk.</div>
                    <div class="font-label-md text-label-md text-on-primary-container">Pustakawan Utama</div>
                </div>
                <div
                    class="w-8 h-8 rounded-full bg-primary-container border border-on-primary-container/30 flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                </div>
            </div>
        </div>
    </header>