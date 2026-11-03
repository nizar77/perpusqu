@if(session('success'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 2000)" 
         x-show="show"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-15 right-0 z-50 p-4 rounded-l-lg bg-emerald-50 text-emerald-800 border border-r-0 border-emerald-200 text-sm font-medium flex items-center gap-3 shadow-lg">
        <span class="material-symbols-outlined">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif