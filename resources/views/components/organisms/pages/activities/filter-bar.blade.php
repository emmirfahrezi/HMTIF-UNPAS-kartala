    {{-- Filter & Search Bar (Sticky & Refined) --}}
    @php
        $statusMap = [
            'Semua' => null,
            'Mendatang' => 'upcoming',
            'Berjalan' => 'ongoing',
            'Selesai' => 'past',
        ];
        $currentStatus = request('status');
    @endphp
    <section class="sticky top-(--nav-height) z-30 bg-white/70 backdrop-blur-xl border-y border-gray-100 py-4 shadow-sm">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <form action="{{ route('activities') }}" method="GET"
                    class="flex flex-col md:flex-row justify-between items-center gap-6 w-full">
                    <div class="flex gap-2 overflow-x-auto pb-1 no-scrollbar w-full md:w-auto">
                        @foreach ($statusMap as $label => $status)
                            @php
                                $isActive = $status === null ? $currentStatus === null : $currentStatus === $status;
                            @endphp
                            <button type="submit" name="status" value="{{ $status ?? '' }}"
                                class="shrink-0 px-6 py-2 rounded-lg {{ $isActive ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-gray-50 text-gray-500 hover:bg-primary/10 hover:text-primary border border-transparent hover:border-primary/20' }} text-sm font-bold transition-all">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                    @if ($currentStatus)
                        <a href="{{ route('activities') }}"
                            class="text-xs font-bold uppercase tracking-widest text-primary hover:underline">
                            Reset Filter
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </section>
