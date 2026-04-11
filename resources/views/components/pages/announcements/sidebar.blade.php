    {{-- Sidebar Components --}}
    @php
        $categories = \App\Models\AnnouncementCategory::query()->orderBy('name')->pluck('name');

        if ($categories->isEmpty()) {
            $categories = collect(['Akademik', 'Organisasi', 'Kegiatan', 'Informasi']);
        }
    @endphp

    <div class="space-y-8 reveal reveal-right">
        <div class="bg-white p-6 rounded-2xl border border-border shadow-sm">
            <h4 class="font-bold text-heading mb-4 pb-2 border-b-2 border-primary-soft">Kategori</h4>
            <ul class="space-y-3">
                @foreach ($categories as $cat)
                    <li><a href="#" class="text-body hover:text-primary transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary/40"></span> {{ $cat }}
                        </a></li>
                @endforeach
            </ul>
        </div>

        <div class="bg-primary p-6 rounded-2xl text-white shadow-lg shadow-primary/20 relative overflow-hidden group">
            <div
                class="absolute inset-x-0 bottom-0 h-1 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity">
            </div>
            <h4 class="font-bold text-lg mb-2">Ingin berkontribusi?</h4>
            <p class="text-white/80 text-sm mb-4 italic">Kirimkan aspirasimu melalui form resmi HMTIF UNPAS.</p>
            <x-atoms.button variant="on-primary" onclick="window.location.href='/aspirations'"
                class="w-full py-2 text-sm">
                Kirim Aspirasi
            </x-atoms.button>
        </div>
    </div>
