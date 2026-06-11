@php
    $archiveId = data_get($archive, 'id');
    $archiveName = data_get($archive, 'name', 'Detail Arsip');
    $fileUrl = data_get($archive, 'file_url', '#');
    $fileName = data_get($archive, 'file_name') ?: basename((string) $fileUrl);
    $typeLabel = data_get($archive, 'type_label', '-');
    $divisionName = data_get($archive, 'division_name') ?: data_get($archive, 'division.name', '-');
    $createdAt = data_get($archive, 'created_at');
    $createdDate = $createdAt instanceof \Carbon\CarbonInterface
        ? $createdAt->format('d M Y')
        : ($createdAt ? \Illuminate\Support\Carbon::parse($createdAt)->format('d M Y') : '-');
    $shareUrl = data_get($archive, 'share_url', '');
    $shortUrl = data_get($archive, 'short_url', '');
    $qrCodeUrl = data_get($archive, 'qr_code_url', '');
    $qrLogoUrl = data_get($archive, 'qr_logo_url', '');
    $shareToken = data_get($archive, 'share_token', '');
    $qrDownloadUrl = filled($shareToken)
        ? route('archives.qr-download', $shareToken)
        : data_get($archive, 'qr_download_url', '');
    $previewUrl = route('dashboard.archives.preview', $archive);
@endphp

<x-layouts.dashboard pageTitle="Detail Arsip" :breadcrumbs="[['label' => 'Pengarsipan', 'href' => '/dashboard/archives'], ['label' => 'Detail']]">
    <div
        x-data="{
            shareArchive: @js([
                'name' => $archiveName,
                'shareUrl' => $shareUrl,
                'shortUrl' => $shortUrl,
                'qrCodeUrl' => $qrCodeUrl,
                'qrDownloadUrl' => $qrDownloadUrl,
                'qrLogoUrl' => $qrLogoUrl,
            ]),
        }"
        class="space-y-8"
    >
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-3">
                <x-atoms.shared.button variant="soft" size="sm" href="/dashboard/archives" class="!p-2 size-9">
                    <x-heroicon-o-arrow-left class="size-5" />
                </x-atoms.shared.button>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 dark:text-white tracking-tight italic uppercase">{{ $archiveName }}</h2>
                    <p class="mt-1 text-sm font-medium text-slate-500 dark:text-slate-400">{{ $typeLabel }} &bull; {{ $divisionName }}</p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-atoms.shared.button type="button" variant="soft" icon="heroicon-o-share"
                    data-archive-name="{{ $archiveName }}"
                    data-share-url="{{ $shareUrl }}"
                    data-short-url="{{ $shortUrl }}"
                    data-qr-code-url="{{ $qrCodeUrl }}"
                    data-qr-download-url="{{ $qrDownloadUrl }}"
                    data-qr-logo-url="{{ $qrLogoUrl }}"
                    onclick="
                        window.dispatchEvent(new CustomEvent('archive-share-data', {
                            detail: {
                                name: this.dataset.archiveName || '',
                                shareUrl: this.dataset.shareUrl || '',
                                shortUrl: this.dataset.shortUrl || '',
                                qrCodeUrl: this.dataset.qrCodeUrl || '',
                                qrDownloadUrl: this.dataset.qrDownloadUrl || '',
                                qrLogoUrl: this.dataset.qrLogoUrl || '',
                            },
                        }));
                        window.dispatchEvent(new CustomEvent('open-modal', {
                            detail: { name: 'archive-share-modal' },
                        }));
                    ">
                    Share
                </x-atoms.shared.button>
                @if($permissions['update'] ?? false)
                    <x-atoms.shared.button variant="soft-warning" href="/dashboard/archives/{{ $archiveId }}/edit" icon="heroicon-o-pencil-square">
                        Edit Data
                    </x-atoms.shared.button>
                @endif
                <x-atoms.shared.button variant="secondary" href="{{ $previewUrl }}" target="_blank" icon="heroicon-o-arrow-top-right-on-square">
                    Buka PDF
                </x-atoms.shared.button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden transition-colors duration-300">
                    <div class="flex items-center justify-between gap-4 border-b border-slate-100 px-6 py-4 dark:border-slate-800">
                        <div class="min-w-0">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Preview PDF</p>
                            <p class="truncate text-sm font-bold text-slate-700 dark:text-slate-200">{{ $fileName ?: 'Dokumen PDF' }}</p>
                        </div>
                        <x-atoms.shared.button href="{{ $previewUrl }}" target="_blank" variant="ghost" size="sm" icon="heroicon-o-arrow-top-right-on-square">
                            Tab Baru
                        </x-atoms.shared.button>
                    </div>
                    <object data="{{ $previewUrl }}" type="application/pdf" class="block h-[72vh] w-full bg-slate-50 dark:bg-slate-950">
                        <iframe src="{{ $previewUrl }}" class="h-[72vh] w-full" title="Preview PDF {{ $archiveName }}"></iframe>
                    </object>
                </div>
            </div>

            <aside class="space-y-8">
                <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300">
                    <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest">Informasi Arsip</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Jenis</p>
                            <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $typeLabel }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Bidang</p>
                            <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $divisionName ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Tanggal Upload</p>
                            <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $createdDate }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10 dark:border-primary/20">
                    <div class="flex gap-4">
                        <div class="size-10 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center shrink-0">
                            <x-heroicon-s-qr-code class="size-5" />
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-primary uppercase tracking-widest mb-1">Share Publik</h4>
                            <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                                Link dan QR Code hanya untuk preview readonly dokumen. Pengelolaan data tetap melalui dashboard.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        @include('dashboard.archives._share-modal')
    </div>
</x-layouts.dashboard>
