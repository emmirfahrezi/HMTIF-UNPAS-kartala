{{-- Form Input - Shared Molecule --}}
@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'helper' => '',
    'options' => [],
    'rows' => 4,
    'searchable' => false,
    'transparent' => false,
    'size' => 'md',
])

@php
    $errorClass = $errors->has($name) ? 'border-red-500/50 ring-4 ring-red-500/10' : 'border-slate-200/50 dark:border-slate-800/50 focus:border-primary focus:ring-4 focus:ring-primary/10';
    $bgClass = $transparent ? 'bg-transparent dark:bg-transparent backdrop-blur-md' : 'bg-white dark:bg-slate-900 shadow-sm';
    
    $paddingClass = $size === 'sm' ? 'px-3 py-2' : 'px-4 py-3';
    $roundedClass = $size === 'sm' ? 'rounded-xl' : 'rounded-2xl';
    
    $baseInputClass = "w-full $paddingClass border $roundedClass text-sm dark:text-white outline-none transition-all duration-300 placeholder:text-slate-400 dark:placeholder:text-slate-600 " . $bgClass . " " . $errorClass;
@endphp

<div class="space-y-2 group">
    @if ($label)
        <label for="{{ $name }}" class="inline-block text-sm font-bold text-slate-700 dark:text-slate-300 group-focus-within:text-primary transition-colors duration-300">
            {{ $label }}
            @if ($required)
                <span class="text-red-500 ml-0.5">*</span>
            @endif
        </label>
    @endif

    @if ($type === 'select' || $type === 'search-select')
        @php
            $isSearchable = $searchable || $type === 'search-select';
            $formattedOptions = [];
            foreach ($options as $optVal => $optLabel) {
                $formattedOptions[] = [
                    'value' => (string) (is_object($optLabel) ? ($optLabel->id ?? $optVal) : $optVal),
                    'label' => (string) (is_object($optLabel) ? ($optLabel->name ?? $optLabel->title ?? $optLabel) : $optLabel),
                ];
            }
        @endphp
        <div x-data="{
            open: false,
            search: '',
            selected: @js((string) old($name, $value)),
            options: @js($formattedOptions),
            get filteredOptions() {
                if (!this.search) return this.options;
                return this.options.filter(opt => opt.label.toLowerCase().includes(this.search.toLowerCase()));
            },
            get selectedLabel() {
                let opt = this.options.find(o => o.value === this.selected);
                if (opt) return opt.label;
                return @js($placeholder) || '— Pilih Opsi —';
            }
        }" x-init="$watch('selected', value => { $dispatch('change', value); })" class="relative" @click.away="open = false">
            <input type="hidden" name="{{ $name }}" :value="selected" {{ $required ? 'required' : '' }} {{ $attributes->whereStartsWith('data-') }}>
            
            <button type="button" @click="open = !open"
                class="{{ $baseInputClass }} flex items-center justify-between text-left"
                :class="open ? 'border-primary ring-4 ring-primary/10' : ''"
                {{ $attributes->whereDoesntStartWith('data-') }}>
                <span x-text="selectedLabel" :class="!selected ? 'text-slate-400 dark:text-slate-600' : 'text-slate-700 dark:text-slate-200 font-medium'"></span>
                <svg class="size-4 text-slate-400 dark:text-slate-600 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-cloak 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2" 
                x-transition:enter-end="opacity-100 translate-y-0"
                class="absolute z-[60] w-full mt-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-2xl overflow-hidden ring-1 ring-black/5 dark:ring-white/5">
                
                @if($isSearchable)
                <div class="p-2 border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-950">
                    <div class="relative">
                        <input type="text" x-model="search" placeholder="Cari..." 
                            class="w-full pl-9 pr-4 py-2 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl text-sm dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                            @keydown.escape="open = false" autofocus>
                        <svg class="absolute left-3 top-2.5 size-4 text-slate-400 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                @endif

                <ul class="max-h-60 overflow-y-auto p-1.5 custom-scrollbar">
                    <template x-for="opt in filteredOptions" :key="opt.value">
                        <li>
                            <button type="button" @click="selected = opt.value; open = false; search = ''"
                                class="w-full text-left px-3 py-2.5 rounded-xl text-sm transition-all flex items-center justify-between group/opt"
                                :class="selected == opt.value ? 'bg-primary/20 text-primary dark:text-emerald-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-primary dark:hover:text-primary'">
                                <span x-text="opt.label"></span>
                                <svg x-show="selected == opt.value" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        </li>
                    </template>
                    <div x-show="filteredOptions.length === 0" class="p-6 text-center">
                        <svg class="mx-auto size-8 text-slate-200 dark:text-slate-800 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-slate-400">Tidak ada hasil ditemukan</p>
                    </div>
                </ul>
            </div>
        </div>
    @elseif ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            class="{{ $baseInputClass }} resize-none"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @elseif ($type === 'richtext')
        <div class="richtext-wrapper relative">
            <input id="{{ $name }}_hidden" type="hidden" name="{{ $name }}" value="{{ old($name, $value) }}">
            <script id="{{ $name }}_initial" type="application/json">@json(old($name, $value))</script>
            <div id="{{ $name }}_editor" class="quill-editor bg-white dark:bg-slate-950/50 backdrop-blur-sm rounded-2xl border border-slate-200 dark:border-slate-800 transition-all duration-300 focus-within:border-primary focus-within:ring-4 focus-within:ring-primary/10 overflow-hidden" data-name="{{ $name }}"
                data-placeholder="{{ $placeholder }}"></div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var container = document.getElementById('{{ $name }}_editor');
                var hiddenInput = document.getElementById('{{ $name }}_hidden');
                var initialEl = document.getElementById('{{ $name }}_initial');
                if (!container || !hiddenInput) return;
                var quill = new Quill(container, {
                    theme: 'snow',
                    placeholder: container.dataset.placeholder || '',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['link', 'blockquote', 'code-block'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['clean']
                        ]
                    }
                });
                if (initialEl && initialEl.textContent) {
                    try {
                        var content = JSON.parse(initialEl.textContent);
                        if (content) quill.root.innerHTML = content;
                    } catch(e) {}
                }
                hiddenInput.value = quill.root.innerHTML;
                quill.on('text-change', function() {
                    hiddenInput.value = quill.root.innerHTML;
                });
            });
        </script>
    @elseif ($type === 'toggle')
        <label class="inline-flex items-center gap-3 cursor-pointer group/toggle">
            <input type="hidden" name="{{ $name }}" value="0" />
            <div class="relative">
                <input type="checkbox" name="{{ $name }}" value="1" id="{{ $name }}"
                    class="peer sr-only"
                    {{ old($name, $value) ? 'checked' : '' }}
                    {{ $attributes }} />
                <div class="w-12 h-6 bg-slate-200 dark:bg-slate-800 rounded-full transition-colors duration-300 peer-checked:bg-primary"></div>
                <div class="absolute top-1 left-1 w-4 h-4 bg-white dark:bg-slate-200 rounded-full transition-transform duration-300 peer-checked:translate-x-6 shadow-sm"></div>
            </div>
            <span class="text-sm font-medium text-slate-600 dark:text-slate-400 group-hover/toggle:text-slate-900 dark:group-hover/toggle:text-white transition-colors">{{ $placeholder ?: $label }}</span>
        </label>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            class="{{ $baseInputClass }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes }} />
    @endif

    @if ($helper)
        <div class="flex items-center gap-1.5 px-1">
            <svg class="size-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-xs text-slate-400 dark:text-slate-500">{{ $helper }}</p>
        </div>
    @endif

    @error($name)
        <div class="flex items-center gap-1.5 px-1 animate-shake">
            <svg class="size-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
        </div>
    @enderror
</div>
