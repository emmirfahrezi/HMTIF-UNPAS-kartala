{{-- Section: Modal Akses Halaman --}}
<div x-data="{
    roleId: null,
    roleName: '',
    menuAccess: [],
    menuItems: @js($menuItems),
    
    init() {
        window.addEventListener('open-modal', (e) => {
            if (e.detail.name === 'role-menu-settings') {
                this.roleId = e.detail.roleId;
                this.roleName = e.detail.roleName;
                this.menuAccess = Array.isArray(e.detail.menuAccess) ? [...e.detail.menuAccess] : [];
            }
        });
    },

    toggleMenu(key) {
        if (this.menuAccess.includes(key)) {
            this.menuAccess = this.menuAccess.filter(k => k !== key);
        } else {
            this.menuAccess.push(key);
        }
    },

    async save() {
        try {
            const res = await fetch(`/dashboard/settings/${this.roleId}/menu`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ menu_access: this.menuAccess })
            });
            const data = await res.json();
            if (data.success) {
                toast('Berhasil menyimpan akses menu', 'success');
                setTimeout(() => location.reload(), 500);
                this.$dispatch('close-modal', { name: 'role-menu-settings' });
            } else {
                toast('Gagal menyimpan akses menu.', 'error');
            }
        } catch (err) {
            toast('Terjadi kesalahan koneksi.', 'error');
        }
    }
}">
    <x-molecules.shared.modal id="role-menu-settings" title="Hak Akses Halaman">
        <div class="mb-4 bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
            <h4 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <x-heroicon-o-bars-3-bottom-left class="size-5 text-primary" />
                Daftar Menu Dashboard &mdash; <span class="text-primary font-black" x-text="roleName"></span>
            </h4>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Centang menu yang diizinkan untuk diakses oleh
                role ini.</p>
        </div>

        <div class="space-y-1 h-[400px] overflow-y-auto pr-2 custom-scrollbar">
            <template x-for="item in menuItems" :key="item.key">
                <div :class="{
                    'flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg transition-colors group cursor-pointer': true,
                    'mb-2 font-bold text-sm text-slate-700 dark:text-slate-200': item.type === 'root',
                    'pt-4 pb-1 pointer-events-none select-none': item.type === 'category',
                    'ml-8 pl-4 border-l-2 border-slate-100 dark:border-slate-800': item.type === 'item' && ['konten', 'organisasi', 'store', 'pengaturan'].includes(item.parent),
                    'ml-16 pl-4 border-l-2 border-slate-100/50 dark:border-slate-800/50': item.type === 'item' && !['konten', 'organisasi', 'store', 'pengaturan'].includes(item.parent)
                }" @click="item.type !== 'category' && toggleMenu(item.key)">
                    
                    <!-- Checkbox / Icon -->
                    <template x-if="item.type !== 'category'">
                        <div class="size-5 rounded-lg border-2 transition-all duration-300 flex items-center justify-center shrink-0"
                             :class="menuAccess.includes(item.key) ? 'bg-primary border-primary text-white' : 'border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950'">
                            <svg class="size-3 text-white transition-all duration-300"
                                 :class="menuAccess.includes(item.key) ? 'scale-100 opacity-100' : 'scale-50 opacity-0'"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </template>
                    
                    <!-- Category Indicator -->
                    <template x-if="item.type === 'category'">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary/45"></span>
                    </template>

                    <!-- Icon (Dashboard Root or standard icons) -->
                    <template x-if="item.key === 'dashboard'">
                        <x-heroicon-o-home class="size-5 text-slate-400 group-hover:text-primary transition-colors" />
                    </template>

                    <!-- Label -->
                    <span x-text="item.label" :class="{
                        'text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded': item.type === 'category',
                        'font-bold text-sm text-slate-700 dark:text-slate-200': item.type === 'root',
                        'font-medium text-sm text-slate-600 dark:text-slate-300': item.type === 'item'
                    }"></span>
                </div>
            </template>
        </div>

        <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-100 dark:border-slate-800">
            <x-atoms.shared.button variant="ghost" type="button"
                @click="$dispatch('close-modal', { name: 'role-menu-settings' })">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button type="button" @click="save()">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </x-molecules.shared.modal>
</div>
