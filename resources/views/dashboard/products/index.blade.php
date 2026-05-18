@php
    $role = \App\Models\Role::where('name', [
        'admin' => 'Superadmin', 'bph' => 'BPH', 'koordinator' => 'Koordinator', 'staff' => 'Staff'
    ][auth()->user()->role] ?? auth()->user()->role)->first();
    $canRead = $role ? (bool)$role->can_read : true;
    $canCreate = $role ? (bool)$role->can_create : true;
    $canUpdate = $role ? (bool)$role->can_update : true;
    $canDelete = $role ? (bool)$role->can_delete : true;
    if (auth()->user()->role === 'admin') {
        $canRead = $canCreate = $canUpdate = $canDelete = true;
    }
@endphp
<x-layouts.dashboard pageTitle="Produk" :breadcrumbs="[['label' => 'Produk']]">
    @if (!$canRead)
        <div class="flex flex-col items-center justify-center pt-16 pb-24 px-4 bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm mt-8">
            <div class="w-16 h-16 bg-red-50 dark:bg-red-500/10 rounded-2xl flex items-center justify-center text-red-500 mb-6 shadow-inner animate-pulse">
                <x-heroicon-o-lock-closed class="size-8" />
            </div>
            <h2 class="text-xl font-extrabold text-slate-800 dark:text-white mb-2 tracking-tight text-center">Akses Terbatas</h2>
            <p class="text-sm text-slate-400 dark:text-slate-500 max-w-md text-center leading-relaxed">Anda tidak memiliki izin untuk melihat data pada halaman ini. Silakan hubungi Administrator jika ini merupakan kesalahan.</p>
        </div>
    @else
        @if ($canCreate)
        <x-slot:headerActions>
            <x-atoms.shared.button 
                href="/dashboard/products/create"
                icon="heroicon-o-plus">
                Tambah Produk
            </x-atoms.shared.button>
        </x-slot:headerActions>
        @endif

        @if ($canCreate || $canUpdate)
        {{-- Collapsible Product Tools --}}
        <div class="mb-8" x-data="{ open: false }">
            {{-- Toggle Bar --}}
            <button type="button" @click="open = !open"
                class="w-full bg-white dark:bg-slate-900/50 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between gap-4 group"
                :class="open && 'rounded-b-none border-b-transparent'">
                <div class="flex items-center gap-4">
                    <div class="size-10 rounded-xl bg-primary/10 dark:bg-primary/20 flex items-center justify-center text-primary shrink-0">
                        <x-heroicon-s-wrench-screwdriver class="size-5" />
                    </div>
                    <div class="text-left">
                        <h3 class="text-sm font-black text-slate-800 dark:text-white leading-tight">Alat Produk</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Kategori, Quick Edit No. Telepon</p>
                    </div>
                </div>
                <div class="size-8 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:bg-primary/10 group-hover:text-primary transition-all duration-300"
                    :class="open && '!bg-primary/10 !text-primary rotate-180'">
                    <x-heroicon-m-chevron-down class="size-4 transition-transform duration-300" />
                </div>
            </button>

            {{-- Expandable Panel --}}
            <div x-show="open" x-collapse x-cloak
                class="bg-white dark:bg-slate-900/50 border border-t-0 border-slate-200 dark:border-slate-800 rounded-b-2xl shadow-sm overflow-hidden">
                <div class="p-6 grid grid-cols-1 {{ $canCreate && $canUpdate ? 'lg:grid-cols-2' : '' }} gap-6 items-stretch border-t border-slate-100 dark:border-slate-800">

                    @if ($canCreate)
                    {{-- Column 1: Manajemen Kategori --}}
                    <div class="flex flex-col">
                        <div class="flex items-center gap-2 mb-4">
                            <x-heroicon-s-tag class="size-4 text-primary" />
                            <h4 class="text-xs font-black text-slate-700 dark:text-slate-200 uppercase tracking-widest">Manajemen Kategori</h4>
                        </div>

                        {{-- Total Kategori Card --}}
                        <div class="flex-1 flex flex-col gap-3">
                            <div class="bg-primary/5 dark:bg-primary/10 rounded-xl p-4 border border-primary/10 dark:border-primary/20 flex items-center gap-4">
                                <div class="size-12 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                                    <x-heroicon-s-tag class="size-6" />
                                </div>
                                <div>
                                    <p class="text-2xl font-black text-slate-800 dark:text-white leading-none">4</p>
                                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mt-1">Total Kategori Produk</p>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-3.5 border border-slate-100 dark:border-slate-800">
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed font-medium">
                                    Kelola kategori untuk mengelompokkan produk toko HMTIF. Gunakan <strong>Tambah Kategori</strong> untuk menambah cepat atau <strong>Lihat Semua</strong> untuk manajemen lengkap.
                                </p>
                            </div>
                        </div>

                        {{-- Quick Add + Manage --}}
                        <div class="flex gap-2 pt-4 mt-4 border-t border-slate-100 dark:border-slate-800">
                            <button type="button" @click="$dispatch('open-modal', { name: 'quick-add-category-product' })"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary/10 dark:bg-primary/20 text-primary rounded-xl text-xs font-bold hover:bg-primary/20 dark:hover:bg-primary/30 transition active:scale-95">
                                <x-heroicon-o-plus-circle class="size-4" />
                                Tambah Kategori
                            </button>
                            <a href="/dashboard/products/categories"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-xs font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                                <x-heroicon-o-table-cells class="size-4" />
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    @endif

                    @if ($canUpdate)
                    {{-- Column 2: Quick Edit No. Telepon --}}
                    <div class="flex flex-col">
                        <div class="flex items-center gap-2 mb-4">
                            <x-heroicon-s-phone class="size-4 text-amber-500" />
                            <h4 class="text-xs font-black text-slate-700 dark:text-slate-200 uppercase tracking-widest">Quick Edit No. Telepon</h4>
                        </div>

                        <form action="/dashboard/products/bulk-phone" method="POST" class="flex flex-col flex-1 gap-4" x-data="{ phone: '' }">
                            @csrf @method('PATCH')
                            <div class="bg-amber-500/5 dark:bg-amber-500/10 rounded-xl p-4 border border-amber-500/10 dark:border-amber-500/20">
                                <div class="flex gap-3">
                                    <div class="size-8 rounded-lg bg-amber-500/10 dark:bg-amber-500/20 text-amber-500 flex items-center justify-center shrink-0 mt-0.5">
                                        <x-heroicon-s-information-circle class="size-4" />
                                    </div>
                                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                                        Mengubah nomor di sini akan memperbarui <strong>seluruh</strong> nomor telepon pemesanan pada semua produk sekaligus.
                                    </p>
                                </div>
                            </div>

                            <x-molecules.shared.forms.form-input
                                label="No. WhatsApp Baru"
                                name="phone_number"
                                placeholder="628123456789"
                                helper="Format: 628... (tanpa + atau spasi)"
                                x-model="phone"
                            />

                            <div class="mt-auto">
                                <x-atoms.shared.button type="submit"
                                    class="w-full justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                                    x-bind:disabled="!phone.trim()">
                                    <x-heroicon-o-arrow-path class="size-4" />
                                    Update Semua No. Telepon
                                </x-atoms.shared.button>
                            </div>
                        </form>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        @endif

        <x-molecules.dashboard.cards.filter-card 
            searchRoute="/dashboard/products" 
            searchPlaceholder="Cari produk...">
            <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
                <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Urutkan</label>
                <div class="w-44">
                    <x-molecules.shared.forms.form-input 
                        type="select"
                        name="sort"
                        :value="request('sort', 'latest')"
                        :options="['latest' => 'Terbaru', 'oldest' => 'Terlama', 'az' => 'Nama A-Z', 'za' => 'Nama Z-A', 'cheap' => 'Termurah', 'expensive' => 'Termahal']"
                        @change="setTimeout(() => $el.closest('form').submit(), 50)"
                    />
                </div>
            </div>

            <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
                <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Kategori</label>
                <div class="w-44">
                    <x-molecules.shared.forms.form-input 
                        type="select"
                        name="category"
                        :value="request('category')"
                        :options="$categories->pluck('name', 'id')->prepend('Semua', '')->toArray()"
                        @change="setTimeout(() => $el.closest('form').submit(), 50)"
                    />
                </div>
            </div>
        </x-molecules.dashboard.cards.filter-card>

        <x-molecules.dashboard.cards.data-table
            :headers="[
                ['label' => 'Nama'],
                ['label' => 'Kategori'],
                ['label' => 'Harga'],
                ['label' => 'Tersedia'],
            ]"
            :selectable="$canDelete"
            :bulkDeleteEnabled="$canDelete"
            :showActions="$canUpdate || $canDelete"
            bulkDeleteRoute="/dashboard/products/bulk-delete">

            @forelse ($products as $item)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                    @if ($canDelete)
                    <td class="px-4 py-4 w-12">
                        <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                    </td>
                    @endif
                    <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200">{{ $item->name }}</td>
                    <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->category?->name ?? '-' }}</td>
                    <td class="px-5 py-4 text-sm text-slate-700 dark:text-slate-200 font-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="px-5 py-4">
                        @if ($item->is_available)
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-500/10 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Ya
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Tidak
                            </span>
                        @endif
                    </td>
                    @if ($canUpdate || $canDelete)
                    <td class="px-5 py-4 text-right">
                        <div class="flex items-center justify-end gap-1">
                            @if ($canUpdate)
                            <x-atoms.shared.button 
                                variant="ghost"
                                size="sm"
                                href="/dashboard/products/{{ $item->id }}/edit"
                                class="size-9 !px-0"
                                title="Edit">
                                <x-heroicon-o-pencil-square class="size-5" />
                            </x-atoms.shared.button>
                            @endif
                            @if ($canDelete)
                            <x-atoms.shared.button 
                                variant="ghost"
                                size="sm"
                                @click="openDeleteModal('/dashboard/products/{{ $item->id }}', 'Hapus produk &quot;{{ $item->name }}&quot;?')"
                                class="size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10"
                                title="Hapus">
                                <x-heroicon-o-trash class="size-5" />
                            </x-atoms.shared.button>
                            @endif
                        </div>
                    </td>
                    @endif
                </tr>
            @empty
            @endforelse

            <x-slot:empty>
                @if ($products->isEmpty())
                    <x-molecules.shared.empty-state title="Belum ada produk" icon="heroicon-o-shopping-bag"
                        createRoute="/dashboard/products/create" createLabel="Tambah Produk" />
                @endif
            </x-slot:empty>

            <x-slot:pagination>
                <x-molecules.dashboard.cards.pagination :paginator="$products" />
            </x-slot:pagination>
        </x-molecules.dashboard.cards.data-table>

        <x-molecules.shared.modal id="quick-add-category-product" title="Tambah Kategori Produk">
            <form action="/dashboard/products/categories" method="POST" class="space-y-4" x-data="slugHelper(@js(old('name')), @js(old('slug')))">
                @csrf
                <x-molecules.shared.forms.form-input 
                    label="Nama Kategori"
                    name="name"
                    required
                    placeholder="Masukan nama kategori..."
                    x-model="sourceValue"
                />
                <x-molecules.shared.forms.form-input 
                    label="Slug"
                    name="slug"
                    readonly
                    placeholder="dibuat otomatis"
                    x-model="slugValue"
                    helper="Slug akan terisi otomatis berdasarkan nama"
                />
                <div class="flex justify-end gap-3 mt-6">
                    <x-atoms.shared.button 
                        variant="ghost"
                        type="button"
                        @click="$dispatch('close-modal', { name: 'quick-add-category-product' })">
                        Batal
                    </x-atoms.shared.button>
                    <x-atoms.shared.button 
                        type="submit">
                        Simpan Kategori
                    </x-atoms.shared.button>
                </div>
            </form>
        </x-molecules.shared.modal>
    @endif
</x-layouts.dashboard>


