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
<x-layouts.dashboard pageTitle="Kategori Pengumuman" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Kategori']]">
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
                href="/dashboard/announcements/categories/create"
                icon="heroicon-o-plus">
                Tambah Kategori
            </x-atoms.shared.button>
        </x-slot:headerActions>
        @endif

    <x-molecules.dashboard.cards.filter-card 
        searchRoute="/dashboard/announcements/categories" 
        searchPlaceholder="Cari kategori..."
    />

    <x-molecules.dashboard.cards.data-table
        :headers="[
            ['label' => 'Nama'],
            ['label' => 'Slug'],
            ['label' => 'Jumlah Pengumuman'],
        ]"
        :selectable="$canDelete"
        :bulkDeleteEnabled="$canDelete"
        :showActions="$canUpdate || $canDelete"
        bulkDeleteRoute="/dashboard/announcements/categories/bulk-delete">

        @forelse ($categories ?? [] as $item)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $item->id }}">
                @if ($canDelete)
                <td class="px-4 py-4 w-12 text-center">
                    <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $item->id }}')" @change="toggleRow('{{ $item->id }}')" />
                </td>
                @endif
                <td class="px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-200">{{ $item->name }}</td>
                <td class="px-5 py-4 text-sm text-slate-400 dark:text-slate-500 font-mono">{{ $item->slug }}</td>
                <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->announcements_count ?? (isset($item->announcements) ? $item->announcements->count() : 0) }}</td>
                @if ($canUpdate || $canDelete)
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        @if ($canUpdate)
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            href="/dashboard/announcements/categories/{{ $item->id }}/edit"
                            class="size-9 !px-0"
                            title="Edit">
                            <x-heroicon-o-pencil-square class="size-5" />
                        </x-atoms.shared.button>
                        @endif
                        @if ($canDelete)
                        <x-atoms.shared.button 
                            variant="ghost"
                            size="sm"
                            @click="openDeleteModal('/dashboard/announcements/categories/{{ $item->id }}', 'Hapus kategori &quot;{{ $item->name }}&quot;?')"
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
            <x-slot:empty>
                <x-molecules.shared.empty-state title="Belum ada kategori" icon="heroicon-o-tag"
                    createRoute="/dashboard/announcements/categories/create" createLabel="Tambah Kategori" />
            </x-slot:empty>
        @endforelse

        @if (isset($categories) && method_exists($categories, 'hasPages'))
            <x-slot:pagination>
                <x-molecules.dashboard.cards.pagination :paginator="$categories" />
            </x-slot:pagination>
        @endif
    </x-molecules.dashboard.cards.data-table>

    <x-molecules.shared.modal-confirm />
    @endif
</x-layouts.dashboard>
