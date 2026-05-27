{{-- Mobile Filter Bar (Hidden on Tablet and above) --}}
@props(['categories'])

@php
    $currentCategoryId = request('category_id');
    $search = request('search');
    $sort = request('sort', 'latest');
@endphp

<section id="announcements-mobile-filter-bar" class="sticky top-24 z-30 bg-white border-b border-slate-200 py-4 shadow-sm transition-all duration-500 md:hidden">
    <div class="mx-auto px-6 max-w-screen-2xl">
        <form action="{{ route('announcements') }}" method="GET" x-data="announcementFilters()" id="announcements-mobile-filter-form"
            class="flex flex-col gap-4">
            
            {{-- Category Pills --}}
            <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar scroll-smooth">
                <input type="hidden" name="category_id" id="category-filter-mobile" value="{{ $currentCategoryId }}">
                
                @php
                    $isAllActive = $currentCategoryId === null || $currentCategoryId === '';
                @endphp
                <button type="button"
                    @click="document.getElementById('category-filter-mobile').value = ''; apply($event)"
                    class="shrink-0 px-4 py-2 rounded-xl transition-all duration-300 text-sm font-bold {{ $isAllActive ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-white text-slate-600 border border-slate-200 hover:border-primary/50 hover:text-primary shadow-sm' }}">
                    Semua
                </button>

                @foreach ($categories as $cat)
                    @php
                        $categoryId = is_string($cat) ? null : $cat->id;
                        $categoryName = is_string($cat) ? $cat : $cat->name;
                        $isActive = !$isAllActive && $categoryId !== null && (string) $currentCategoryId === (string) $categoryId;
                    @endphp
                    @if ($categoryId !== null)
                        <button type="button"
                            @click="document.getElementById('category-filter-mobile').value = '{{ $categoryId }}'; apply($event)"
                            class="shrink-0 px-4 py-2 rounded-xl transition-all duration-300 text-sm font-bold {{ $isActive ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-white text-slate-600 border border-slate-200 hover:border-primary/50 hover:text-primary shadow-sm' }}">
                            {{ $categoryName }}
                        </button>
                    @endif
                @endforeach
            </div>

            {{-- Search & Sort --}}
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full">
                {{-- Sort Dropdown --}}
                <div class="w-full sm:w-48">
                    <x-molecules.shared.forms.form-input 
                        type="select"
                        name="sort"
                        :value="$sort"
                        :options="['latest' => 'Terbaru', 'oldest' => 'Terlama', 'az' => 'A - Z', 'za' => 'Z - A']"
                        :transparent="false"
                        :size="'sm'"
                        @change="setTimeout(() => apply($event), 50)"
                    />
                </div>

                {{-- Search Input --}}
                <div class="relative w-full group">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Cari pengumuman..."
                        @input="onSearchInput($event)" maxlength="50"
                        class="w-full pl-10 pr-10 py-2 bg-white border border-slate-200 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl text-sm font-medium transition-all placeholder:text-slate-400 shadow-sm hover:border-slate-300 outline-none">
                    <x-heroicon-o-magnifying-glass
                        class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4 text-gray-400 group-focus-within:text-primary transition-colors" />
                </div>

                @if ($currentCategoryId || $search || $sort !== 'latest')
                    <a href="{{ route('announcements') }}"
                        class="shrink-0 text-xs font-black uppercase tracking-widest text-primary hover:underline transition-all">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</section>
