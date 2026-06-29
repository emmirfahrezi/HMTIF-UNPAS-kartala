    {{-- Sidebar Components --}}
    @props(['categories'])

    <div class="space-y-8 reveal reveal-up">
        <div class="bg-white p-6 rounded-2xl border border-border shadow-sm hidden md:block">
            <h4 class="font-bold text-heading mb-4 pb-2 border-b-2 border-primary-soft">Kategori</h4>
            <ul class="space-y-3">
                @php
                    $currentCategoryId = request('category_id');
                    $isAllActive = $currentCategoryId === null || $currentCategoryId === '';
                @endphp
                
                {{-- Opsi Semua --}}
                <li>
                    <a href="{{ route('announcements', ['search' => request('search'), 'sort' => request('sort')]) }}"
                        class="text-body hover:text-primary transition-colors flex items-center gap-2 {{ $isAllActive ? 'text-primary font-bold' : '' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $isAllActive ? 'bg-primary' : 'bg-primary/40' }}"></span> Semua
                    </a>
                </li>

                @foreach ($categories as $cat)
                    @php
                        $categoryId = is_string($cat) ? null : $cat->id;
                        $categoryName = is_string($cat) ? $cat : $cat->name;
                        $isActive = !$isAllActive && $categoryId !== null && (string) $currentCategoryId === (string) $categoryId;
                    @endphp
                    <li><a href="{{ $categoryId ? route('announcements', ['category_id' => $categoryId, 'search' => request('search'), 'sort' => request('sort')]) : route('announcements', ['search' => request('search'), 'sort' => request('sort')]) }}"
                            class="text-body hover:text-primary transition-colors flex items-center gap-2 {{ $isActive ? 'text-primary font-bold' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary/40"></span> {{ $categoryName }}
                        </a></li>
                @endforeach
            </ul>
        </div>


        <div class="bg-primary p-6 rounded-2xl text-white shadow-lg shadow-primary/20 relative overflow-hidden group">
            <div
                class="absolute inset-x-0 bottom-0 h-1 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity">
            </div>
            <h4 class="font-bold text-lg mb-2">Ingin berkontribusi?</h4>
            <p class="text-white/80 text-sm mb-4 italic">Kirimkan aspirasimu melalui form resmi HMTIF-UNPAS.</p>
            <x-atoms.shared.button variant="secondary" data-nav-target="{{ route('aspirations') }}"
                class="w-full py-2 text-sm">
                Kirim Aspirasi
            </x-atoms.shared.button>
        </div>
    </div>
