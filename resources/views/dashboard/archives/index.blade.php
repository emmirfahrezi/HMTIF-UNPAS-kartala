@php
    $archiveTypes = $archiveTypes ?? [
        'general_letter' => 'Surat Umum',
        'lpj' => 'LPJ',
        'proposal' => 'Proposal',
        'nota' => 'Nota',
    ];
    $activeType = request('type', array_key_first($archiveTypes));
    $divisionOptions = ['' => 'Semua Bidang'] + collect($divisions ?? [])
        ->mapWithKeys(fn ($division) => [data_get($division, 'id') => data_get($division, 'name')])
        ->filter(fn ($name, $id) => filled($id) && filled($name))
        ->all();
@endphp

<x-layouts.dashboard pageTitle="Pengarsipan" :breadcrumbs="[['label' => 'Pengarsipan']]">
    <div
        x-data="{
            shareArchive: {
                name: '',
                shareUrl: '',
                qrCodeUrl: '',
                qrDownloadUrl: '',
            },
        }"
        class="space-y-8"
    >
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-800 dark:text-white tracking-tight italic uppercase">Pengarsipan</h2>
                <p class="mt-1 text-sm font-medium text-slate-500 dark:text-slate-400">Pusat penyimpanan PDF surat, LPJ, proposal, dan nota.</p>
            </div>
            @if($permissions['create'] ?? false)
                <x-atoms.shared.button href="/dashboard/archives/create" icon="heroicon-o-plus">
                    Tambah Arsip
                </x-atoms.shared.button>
            @endif
        </div>

        <div class="flex gap-2 overflow-x-auto pb-1">
            @foreach($archiveTypes as $type => $label)
                @php
                    $query = array_merge(request()->except(['page', 'type']), ['type' => $type]);
                    $href = url('/dashboard/archives') . '?' . http_build_query($query);
                    $isActive = $activeType === $type;
                @endphp
                <a href="{{ $href }}"
                    class="shrink-0 rounded-2xl border px-4 py-2 text-xs font-black uppercase tracking-widest transition {{ $isActive ? 'border-primary bg-primary text-white shadow-lg shadow-primary/20' : 'border-slate-200 bg-white text-slate-500 hover:border-primary/30 hover:text-primary dark:border-slate-800 dark:bg-slate-900/50 dark:text-slate-400' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <x-molecules.dashboard.cards.filter-card searchRoute="/dashboard/archives" searchPlaceholder="Cari nama surat...">
            <input type="hidden" name="type" value="{{ $activeType }}">

            <div class="w-48">
                <x-molecules.shared.forms.form-input
                    type="select"
                    name="division"
                    :value="request('division', '')"
                    :options="$divisionOptions"
                    :size="'sm'"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)" />
            </div>

            <div class="w-44">
                <x-molecules.shared.forms.form-input
                    type="select"
                    name="sort"
                    :value="request('sort', 'latest')"
                    :options="[
                        'latest' => 'Terbaru',
                        'oldest' => 'Terlama',
                        'az' => 'A - Z',
                        'za' => 'Z - A',
                    ]"
                    :size="'sm'"
                    @change="setTimeout(() => $el.closest('form').submit(), 50)" />
            </div>
        </x-molecules.dashboard.cards.filter-card>

        <x-molecules.dashboard.cards.data-table
            :selectable="$permissions['delete'] ?? false"
            :bulkDeleteEnabled="$permissions['delete'] ?? false"
            :showActions="true"
            bulkDeleteRoute="/dashboard/archives/bulk-delete"
            :headers="[
                ['label' => 'Nama Surat'],
                ['label' => 'Jenis'],
                ['label' => 'Bidang'],
                ['label' => 'File'],
                ['label' => 'Tanggal'],
            ]">

            @forelse ($archives ?? [] as $item)
                @php
                    $archiveId = data_get($item, 'id');
                    $archiveName = data_get($item, 'name', '-');
                    $typeLabel = data_get($item, 'type_label') ?: ($archiveTypes[data_get($item, 'type')] ?? data_get($item, 'type', '-'));
                    $divisionName = data_get($item, 'division_name') ?: data_get($item, 'division.name', '-');
                    $fileUrl = data_get($item, 'file_url', '#');
                    $fileName = data_get($item, 'file_name') ?: basename((string) $fileUrl);
                    $createdAt = data_get($item, 'created_at');
                    $createdDate = $createdAt instanceof \Carbon\CarbonInterface
                        ? $createdAt->format('d M Y')
                        : ($createdAt ? \Illuminate\Support\Carbon::parse($createdAt)->format('d M Y') : '-');
                    $shareUrl = data_get($item, 'share_url') ?: url('/archives/' . $archiveId . '/share');
                    $qrCodeUrl = data_get($item, 'qr_code_url', '');
                    $qrDownloadUrl = data_get($item, 'qr_download_url', '');
                @endphp
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200" data-row-id="{{ $archiveId }}">
                    @if($permissions['delete'] ?? false)
                        <td class="px-4 py-4 text-center">
                            <x-atoms.shared.checkbox x-bind:checked="isSelected('{{ $archiveId }}')" @change="toggleRow('{{ $archiveId }}')" />
                        </td>
                    @endif
                    <td class="px-5 py-4">
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $archiveName }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <span class="rounded-full bg-primary/5 px-2.5 py-1 text-[10px] font-black uppercase tracking-widest text-primary dark:bg-primary/10">
                            {{ $typeLabel }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-sm font-medium text-slate-500 dark:text-slate-400">{{ $divisionName ?: '-' }}</td>
                    <td class="px-5 py-4">
                        <a href="{{ $fileUrl }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex max-w-48 items-center gap-2 text-xs font-bold text-primary hover:underline">
                            <x-heroicon-o-document-text class="size-4 shrink-0" />
                            <span class="truncate">{{ $fileName ?: 'PDF' }}</span>
                        </a>
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">
                        {{ $createdDate }}
                    </td>
                    <td class="px-5 py-4 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <x-atoms.shared.button variant="ghost" size="sm" href="/dashboard/archives/{{ $archiveId }}" class="size-9 !px-0" title="Preview Arsip">
                                <x-heroicon-o-eye class="size-5 text-slate-400 hover:text-primary transition-colors" />
                            </x-atoms.shared.button>
                            <x-atoms.shared.button
                                variant="ghost"
                                size="sm"
                                class="size-9 !px-0"
                                title="Bagikan Arsip"
                                @click="shareArchive = @js([
                                    'name' => $archiveName,
                                    'shareUrl' => $shareUrl,
                                    'qrCodeUrl' => $qrCodeUrl,
                                    'qrDownloadUrl' => $qrDownloadUrl,
                                ]); $dispatch('open-modal', { name: 'archive-share-modal' })">
                                <x-heroicon-o-share class="size-5 text-slate-400 hover:text-primary transition-colors" />
                            </x-atoms.shared.button>
                            @if($permissions['update'] ?? false)
                                <x-atoms.shared.button variant="ghost" size="sm" href="/dashboard/archives/{{ $archiveId }}/edit" class="size-9 !px-0" title="Edit Arsip">
                                    <x-heroicon-o-pencil-square class="size-5 text-slate-400 hover:text-amber-500 transition-colors" />
                                </x-atoms.shared.button>
                            @endif
                            @if($permissions['delete'] ?? false)
                                <x-atoms.shared.button variant="ghost" size="sm" class="size-9 !px-0" title="Hapus Arsip"
                                    @click="openDeleteModal('/dashboard/archives/{{ $archiveId }}', 'Hapus arsip &quot;{{ e($archiveName) }}&quot;?')">
                                    <x-heroicon-o-trash class="size-5 text-slate-400 hover:text-red-500 transition-colors" />
                                </x-atoms.shared.button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <x-slot:empty>
                    <x-molecules.shared.empty-state title="Belum ada arsip" icon="heroicon-o-archive-box" />
                </x-slot:empty>
            @endforelse

            @if(isset($archives) && method_exists($archives, 'hasPages'))
                <x-slot:pagination>
                    <x-molecules.dashboard.cards.pagination :paginator="$archives" />
                </x-slot:pagination>
            @endif
        </x-molecules.dashboard.cards.data-table>

        @include('dashboard.archives._share-modal')
    </div>
</x-layouts.dashboard>
