{{-- Master Global Confirmation Modal --}}
<div
    x-data="{ 
        show: false, 
        title: '',
        message: '',
        action: '', 
        method: 'POST',
        confirmLabel: 'Ya, Lanjutkan',
        variant: 'primary',
        icon: 'info',
        isBulk: false,
        count: 0,
        targetFormId: null,

        submit() {
            if (this.isBulk && this.targetFormId) {
                document.getElementById(this.targetFormId).submit();
            } else {
                this.$refs.confirmForm.submit();
            }
        }
    }"
    x-show="show"
    x-on:open-confirm-modal.window="
        show = true; 
        title = $event.detail.title;
        message = $event.detail.message;
        action = $event.detail.action;
        method = $event.detail.method;
        confirmLabel = $event.detail.confirmLabel;
        variant = $event.detail.variant;
        icon = $event.detail.icon;
        isBulk = $event.detail.isBulk;
        count = $event.detail.count;
        targetFormId = $event.detail.targetFormId;
    "
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-[100] overflow-y-auto"
>
    {{-- Backdrop --}}
    <div 
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="show = false"
    ></div>

    {{-- Modal Content --}}
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative min-h-screen flex items-center justify-center p-4 pointer-events-none"
    >
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl w-full max-w-md overflow-hidden pointer-events-auto transition-colors duration-300">
            <div class="p-8 text-center">
                {{-- Dynamic Icon Container --}}
                <div class="mx-auto flex items-center justify-center size-20 rounded-full mb-6 ring-8"
                    :class="{
                        'bg-red-50 dark:bg-red-500/10 text-red-500 ring-red-50/50 dark:ring-red-500/5': variant === 'danger',
                        'bg-primary/10 dark:bg-primary/20 text-primary ring-primary/5 dark:ring-primary/10': variant === 'primary',
                        'bg-amber-50 dark:bg-amber-500/10 text-amber-500 ring-amber-50/50 dark:ring-amber-500/5': variant === 'warning'
                    }">
                    
                    {{-- Trash Icon --}}
                    <template x-if="icon === 'trash'">
                        <x-heroicon-o-trash class="size-10" />
                    </template>

                    {{-- Logout Icon --}}
                    <template x-if="icon === 'logout'">
                        <x-heroicon-o-arrow-left-on-rectangle class="size-10" />
                    </template>

                    {{-- Info/Generic Icon --}}
                    <template x-if="icon === 'info'">
                        <x-heroicon-o-information-circle class="size-10" />
                    </template>

                    {{-- Warning Icon --}}
                    <template x-if="icon === 'warning'">
                        <x-heroicon-o-exclamation-triangle class="size-10" />
                    </template>
                </div>

                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2" x-text="title"></h3>
                <p class="text-slate-500 dark:text-slate-400 mb-8" x-text="message"></p>

                <form :action="action" method="POST" x-ref="confirmForm">
                    @csrf
                    <template x-if="method !== 'POST'">
                        <input type="hidden" name="_method" :value="method">
                    </template>

                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" @click="show = false" 
                            class="px-6 py-3.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-2xl text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                            Batal
                        </button>
                        <button type="button" @click="submit()" 
                            class="px-6 py-3.5 text-white rounded-2xl text-sm font-bold transition shadow-lg active:scale-95"
                            :class="{
                                'bg-red-500 hover:bg-red-600 shadow-red-200 dark:shadow-red-500/20': variant === 'danger',
                                'bg-primary hover:bg-primary/90 shadow-primary/20': variant === 'primary',
                                'bg-amber-500 hover:bg-amber-600 shadow-amber-200 dark:shadow-amber-500/20': variant === 'warning'
                            }"
                            x-text="confirmLabel">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
