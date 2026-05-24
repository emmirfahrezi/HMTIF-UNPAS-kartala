
<x-layouts.dashboard pageTitle="Pengumuman" :breadcrumbs="[['label' => 'Pengumuman']]">
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
                href="/dashboard/announcements/create"
                icon="heroicon-o-plus">
                Tambah Pengumuman
            </x-atoms.shared.button>
        </x-slot:headerActions>
        @endif

    @if ($canCreate)
    <x-molecules.dashboard.cards.category-card 
        title="Kategori Pengumuman"
        subtitle="Kelola kategori untuk membagi jenis pengumuman"
        addModalId="quick-add-category"
        manageRoute="/dashboard/announcements/categories"
    />
    @endif

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/announcements" 
        searchPlaceholder="Cari pengumuman...">
        <div class="flex items-center gap-2 border-l border-slate-100 dark:border-slate-800 pl-3 transition-colors duration-300">
            <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">Urutkan</label>
            <div class="w-44">
                <x-molecules.shared.forms.form-input 
                    type="select"
                    name="sort"
                    :value="request('sort', 'latest')"
                    :options="['latest' => 'Terbaru', 'oldest' => 'Terlama', 'az' => 'Judul A-Z', 'za' => 'Judul Z-A']"
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
            ['label' => 'Judul'],
            ['label' => 'Kategori'],
            ['label' => 'Tanggal Terbit'],
        ]"
        :selectable="$canDelete"
        :bulkDeleteEnabled="$canDelete"
        :showActions="$canUpdate || $canDelete"
        bulkDeleteRoute="/dashboard/announcements/bulk-delete">

        @forelse ($announcements as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                @if ($canDelete)
                <td class="px-4 py-4 w-12">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                @endif
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200 max-w-xs truncate">{{ $item->title }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->category?->name ?? '-' }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->published_at?->format('d M Y') ?? '-' }}</td>
                @if ($canUpdate || $canDelete)
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        @if ($canUpdate)
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/announcements/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        @endif
                        @if ($canDelete)
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/announcements/{{ $item->id }}', 'Hapus pengumuman &quot;{{ $item->title }}&quot;?')"
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
            @if ($announcements->isEmpty())
                <x-molecules.shared.empty-state title="Belum ada pengumuman" icon="heroicon-o-megaphone"
                    createRoute="/dashboard/announcements/create" createLabel="Tambah Pengumuman" />
            @endif
        </x-slot:empty>

        <x-slot:pagination>
            <x-molecules.dashboard.cards.pagination :paginator="$announcements" />
        </x-slot:pagination>
    </x-molecules.dashboard.cards.data-table>

    <x-molecules.shared.modal id="quick-add-category" title="Tambah Kategori Pengumuman">
        <form action="/dashboard/announcements/categories" method="POST" class="space-y-4" x-data="slugHelper(@js(old('name')), @js(old('slug')))">
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
                    @click="$dispatch('close-modal', { name: 'quick-add-category' })">
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
