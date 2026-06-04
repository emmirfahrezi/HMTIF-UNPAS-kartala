@php
    $archiveName = data_get($archive ?? null, 'name', 'Arsip HMTIF-UNPAS');
    $typeLabel = data_get($archive ?? null, 'type_label', '-');
    $divisionName = data_get($archive ?? null, 'division_name') ?: data_get($archive ?? null, 'division.name', '-');
    $fileUrl = data_get($archive ?? null, 'file_url', '');
    $fileName = data_get($archive ?? null, 'file_name') ?: basename((string) $fileUrl);
    $shareToken = data_get($archive ?? null, 'share_token');
    $downloadUrl = data_get($archive ?? null, 'download_url');
    $createdAt = data_get($archive ?? null, 'created_at');
    $createdDate = $createdAt instanceof \Carbon\CarbonInterface
        ? $createdAt->format('d M Y')
        : ($createdAt ? \Illuminate\Support\Carbon::parse($createdAt)->format('d M Y') : '-');

    if (! $downloadUrl && filled($shareToken) && \Illuminate\Support\Facades\Route::has('archives.download')) {
        $downloadUrl = route('archives.download', $shareToken);
    }

    $downloadUrl = $downloadUrl ?: $fileUrl;
@endphp

<x-layouts.app
    :title="$archiveName . ' | Arsip HMTIF-UNPAS'"
    description="Preview readonly dokumen arsip HMTIF-UNPAS."
    keywords="Arsip HMTIF, Dokumen HMTIF, HMTIF UNPAS"
    :transparent="false"
>
    <main class="bg-slate-50 text-slate-900">
        <section class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-screen-2xl flex-col gap-6 px-6 py-10 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div class="max-w-3xl">
                    <p class="text-xs font-black uppercase tracking-widest text-primary">Arsip Publik</p>
                    <h1 class="mt-3 text-3xl font-black text-slate-950 md:text-4xl">{{ $archiveName }}</h1>
                    <p class="mt-3 text-sm font-semibold text-slate-500">
                        {{ $typeLabel }} &bull; {{ $divisionName ?: '-' }} &bull; {{ $createdDate }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    @if($fileUrl)
                        <x-atoms.shared.button href="{{ $fileUrl }}" target="_blank" variant="soft" icon="heroicon-o-arrow-top-right-on-square">
                            Buka PDF
                        </x-atoms.shared.button>
                    @endif
                    @if($downloadUrl)
                        <x-atoms.shared.button href="{{ $downloadUrl }}" icon="heroicon-o-arrow-down-tray">
                            Download PDF
                        </x-atoms.shared.button>
                    @endif
                </div>
            </div>
        </section>

        <section class="py-8 lg:py-12">
            <div class="mx-auto grid max-w-screen-2xl grid-cols-1 gap-8 px-6 lg:grid-cols-4 lg:px-8">
                <aside class="lg:col-span-1">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xs font-black uppercase tracking-widest text-slate-950">Informasi Dokumen</h2>
                        <dl class="mt-6 space-y-5">
                            <div>
                                <dt class="text-[10px] font-black uppercase tracking-widest text-slate-400">Nama File</dt>
                                <dd class="mt-1 break-words text-sm font-bold text-slate-700">{{ $fileName ?: '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jenis</dt>
                                <dd class="mt-1 text-sm font-bold text-slate-700">{{ $typeLabel }}</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-black uppercase tracking-widest text-slate-400">Bidang</dt>
                                <dd class="mt-1 text-sm font-bold text-slate-700">{{ $divisionName ?: '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                </aside>

                <div class="lg:col-span-3">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <div class="flex items-center justify-between gap-4 border-b border-slate-100 px-5 py-4">
                            <div class="min-w-0">
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Preview PDF</p>
                                <p class="truncate text-sm font-bold text-slate-700">{{ $fileName ?: 'Dokumen PDF' }}</p>
                            </div>
                        </div>

                        @if($fileUrl)
                            <object data="{{ $fileUrl }}" type="application/pdf" class="block h-[76vh] w-full bg-slate-100">
                                <iframe src="{{ $fileUrl }}" class="h-[76vh] w-full" title="Preview PDF {{ $archiveName }}"></iframe>
                            </object>
                        @else
                            <div class="p-12 text-center">
                                <x-heroicon-o-document-text class="mx-auto size-12 text-slate-300" />
                                <p class="mt-4 text-sm font-bold text-slate-500">File PDF tidak tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layouts.app>
