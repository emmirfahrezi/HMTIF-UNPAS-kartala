<x-layouts.app :title="$announcement->title . ' | HMTIF-UNPAS'" :description="$announcement->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($announcement->body), 160)"
    keywords="Info Penting HMTIF, Warta Terbaru Informatika, Pengumuman Mahasiswa" :transparent="false">
    <x-slot:head>
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Article",
            "headline": "{{ e($announcement->title) }}",
            "description": "{{ e($announcement->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($announcement->body ?? ''), 160)) }}",
            "image": "{{ $announcement->thumbnail_url }}",
            "url": "{{ url()->current() }}",
            "datePublished": "{{ $announcement->created_at->toIso8601String() }}",
            "dateModified": "{{ $announcement->updated_at->toIso8601String() }}",
            "publisher": {
                "@@type": "Organization",
                "name": "HMTIF-UNPAS",
                "url": "{{ url('/') }}"
            }
        }
        </script>
    </x-slot:head>
    @php
        $heroImage = $announcement->thumbnail_url;
        $relatedAnnouncements = $relatedAnnouncements ?? collect();
        
        $previousUrl = url()->previous();
        $backUrl = route('announcements');
        $backLabel = 'Kembali ke Pengumuman';
        
        if ($previousUrl && $previousUrl !== url()->current() && str_contains($previousUrl, request()->getHost())) {
            $backUrl = $previousUrl;
            if ($previousUrl === url('/') || $previousUrl === url('/index') || $previousUrl === url('/home')) {
                $backLabel = 'Kembali ke Beranda';
            }
        }
    @endphp

    <x-molecules.pages.sections.page-hero icon="heroicon-o-megaphone">
        <div class="text-left max-w-3xl -mt-16 md:-mt-24 relative z-20">
            <a href="{{ $backUrl }}"
                class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:-translate-x-1 transition-transform group mb-8">
                <x-heroicon-o-arrow-left class="size-4" />
                {{ $backLabel }}
            </a>

            <div class="mt-2">
                <div class="flex flex-wrap items-center gap-3 mb-5">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em]">
                        {{ $announcement->category_name }}
                    </span>
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-400">
                        {{ optional($announcement->published_at)->translatedFormat('d F Y') ?: '-' }}
                    </span>
                </div>
                <h1
                    class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter text-heading leading-tight">
                    {{ $announcement->title }}
                </h1>
                <p class="mt-5 text-base md:text-lg text-body/70 leading-relaxed">
                    {{ $announcement->excerpt ?: 'Pengumuman resmi HMTIF-UNPAS.' }}
                </p>
            </div>
        </div>
    </x-molecules.pages.sections.page-hero>

    <section class="py-10 md:py-16 bg-section/30 min-h-screen">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">

            {{-- 2-Column Grid Starting from Image --}}
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-10 items-start">

                {{-- Left Column (Image + Body) --}}
                <div class="space-y-10">
                    <div
                        class="rounded-[2rem] overflow-hidden border border-slate-200 shadow-lg bg-slate-50 w-full h-[300px] md:h-[500px]">
                        <img src="{{ $heroImage }}" alt="{{ $announcement->title }}" class="w-full h-full object-cover"
                            data-fallback-src="{{ asset('images/placeholders/announcement.svg') }}">
                    </div>

                    <article class="bg-white rounded-[2rem] border border-slate-200 p-8 md:p-10 shadow-sm">
                        <h2 class="text-2xl font-black italic uppercase tracking-tighter text-heading mb-6">Isi
                            Pengumuman</h2>
                        <div
                            class="public-richtext-content prose prose-slate max-w-none prose-headings:font-black prose-headings:tracking-tight prose-a:text-primary">
                            {!! $announcement->body !!}
                        </div>

                        @if ($announcement->file)
                            <div class="mt-8 pt-6 border-t border-slate-100">
                                <a href="{{ $announcement->file }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                                    <x-heroicon-o-paper-clip class="size-4" />
                                    Buka Lampiran
                                </a>
                            </div>
                        @endif
                    </article>
                </div>

                {{-- Right Column (Sidebar) --}}
                <aside class="space-y-6">
                    <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-sm font-black uppercase tracking-[0.2em] text-slate-400 mb-5">Pengumuman Terkait
                        </h3>
                        <div class="space-y-4">
                            @forelse ($relatedAnnouncements as $item)
                                <a href="{{ route('announcements.show', $item->slug) }}"
                                    class="block rounded-2xl border border-slate-100 p-4 hover:border-primary/20 hover:bg-slate-50 transition-all">
                                    <div class="text-[10px] font-black uppercase tracking-widest text-primary mb-2">
                                        {{ optional($item->category)->name ?: 'Umum' }}
                                    </div>
                                    <div class="font-bold text-heading leading-snug">{{ $item->title }}</div>
                                    <div class="text-xs text-slate-400 mt-2">
                                        {{ optional($item->published_at)->translatedFormat('d M Y') ?: '-' }}
                                    </div>
                                </a>
                            @empty
                                <p class="text-sm text-body/60">Belum ada pengumuman terkait.</p>
                            @endforelse
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</x-layouts.app>
