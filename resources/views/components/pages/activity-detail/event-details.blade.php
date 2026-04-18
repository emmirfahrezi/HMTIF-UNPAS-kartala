@php
    $activity = \App\Models\Activity::query()->latest('start_date')->first();
    $thumbnail = (string) ($activity?->thumbnail ?? '');
    $isLocalThumbnail =
        $thumbnail !== '' && \Illuminate\Support\Str::startsWith($thumbnail, ['/', 'storage/', 'images/', url('/')]);
    $activityImage = $isLocalThumbnail ? $thumbnail : asset('images/placeholders/activity.svg');
@endphp

{{-- Main Image & Description --}}
<div class="lg:col-span-2 space-y-10 reveal reveal-up">
    <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-video border-8 border-white">
        <img src="{{ $activityImage }}" alt="Poster Utama Kegiatan HMTIF UNPAS" class="w-full h-full object-cover"
            onerror="this.onerror=null;this.src='{{ asset('images/placeholders/activity.svg') }}';">
    </div>

    <div class="prose prose-lg max-w-none text-body leading-relaxed space-y-6">
        <p class="font-bold text-xl text-heading italic uppercase tracking-tighter">
            {{ $activity?->description ?: 'Transformasi Kepemimpinan untuk Informatika yang Progresif.' }}
        </p>
        <p>
            {{ \Illuminate\Support\Str::limit($activity?->body ?: 'Belum ada detail kegiatan tersedia.', 420) }}
        </p>
        <p>
            Kegiatan ini dirancang untuk memperkuat kolaborasi antar mahasiswa serta memastikan implementasi program
            kerja berjalan terarah sesuai kebutuhan civitas Informatika UNPAS.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-10 font-bold italic uppercase tracking-tighter text-sm">
            <div class="p-6 bg-white rounded-2xl border border-border shadow-sm flex items-center gap-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <x-heroicon-o-user-group class="size-6" />
                </div>
                Terbuka untuk seluruh anggota
            </div>
            <div class="p-6 bg-white rounded-2xl border border-border shadow-sm flex items-center gap-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <x-heroicon-o-academic-cap class="size-6" />
                </div>
                Poin Keaktifan Mahasiswa (PKM)
            </div>
        </div>
    </div>
</div>
