{{-- Global Flash Message Component (Alpine.js Powered) --}}
@php
    $type = session('success') || session('aspiration_success') ? 'success' : (session('error') ? 'error' : 'warning');
    $message = session('success') ?? session('error') ?? session('warning') ?? '';
    
    if (session('aspiration_success')) {
        $message = 'Aspirasi Anda berhasil dikirim! ' . (session('tracking_code') ? 'Kode Tracking: ' . session('tracking_code') : 'Terima kasih atas suaramu.');
    }
    
    $icons = [
        'success' => 'heroicon-o-check-circle',
        'error' => 'heroicon-o-x-circle',
        'warning' => 'heroicon-o-exclamation-circle',
    ];
    $colors = [
        'success' => 'bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600',
        'error' => 'bg-red-100 dark:bg-red-500/20 text-red-600',
        'warning' => 'bg-amber-100 dark:bg-amber-500/20 text-amber-600',
    ];
@endphp

    <div 
        x-data="{ 
            show: false, 
            type: '{{ $type ?? 'success' }}',
            message: '{{ $message ?? '' }}',
            icons: {
                success: 'heroicon-o-check-circle',
                error: 'heroicon-o-x-circle',
                warning: 'heroicon-o-exclamation-circle',
            },
            colors: {
                success: 'bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600',
                error: 'bg-red-100 dark:bg-red-500/20 text-red-600',
                warning: 'bg-amber-100 dark:bg-amber-500/20 text-amber-600',
            },
            init() {
                if (this.message) {
                    this.show = true;
                    setTimeout(() => this.show = false, 5000);
                }
            }
        }" 
        x-on:toast.window="
            message = $event.detail.message;
            type = $event.detail.type || 'success';
            show = true;
            setTimeout(() => show = false, 5000);
        "
        x-show="show" 
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-x-12"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-12"
        class="fixed top-6 right-6 z-[100] max-w-sm w-full bg-white dark:bg-slate-900 rounded-2xl shadow-2xl shadow-slate-200/50 dark:shadow-black/50 border border-slate-100 dark:border-slate-800 p-4 flex items-start gap-4 pointer-events-auto transition-all duration-300"
        role="alert"
    >
        <div class="p-2 rounded-xl shrink-0" :class="colors[type]">
            <template x-if="type === 'success'"><x-heroicon-o-check-circle class="size-6" /></template>
            <template x-if="type === 'error'"><x-heroicon-o-x-circle class="size-6" /></template>
            <template x-if="type === 'warning'"><x-heroicon-o-exclamation-circle class="size-6" /></template>
        </div>
        
        <div class="flex-1 pt-1">
            <h4 class="text-sm font-bold text-slate-900 dark:text-white leading-tight" x-text="type === 'success' ? 'Berhasil' : (type === 'error' ? 'Kesalahan' : 'Peringatan')"></h4>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 font-medium leading-relaxed" x-text="message"></p>
        </div>

        <button type="button" @click="show = false" class="p-1 text-slate-400 dark:text-slate-600 hover:text-slate-600 dark:hover:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg transition-all shrink-0">
            <x-heroicon-o-x-mark class="size-5" />
        </button>
    </div>

