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
    'nameExpression' => null,
    'selectedExpression' => null,
    'modelExpression' => null,
    'optionValueKey' => null,
    'optionLabelKey' => null,
])

@php
    $errorClass = $errors->has($name) ? 'border-red-500/50 ring-4 ring-red-500/10' : 'border-slate-200/50 dark:border-slate-800/50 focus:border-primary focus:ring-4 focus:ring-primary/10';
    $bgClass = $transparent ? 'bg-transparent dark:bg-transparent backdrop-blur-md' : 'bg-white dark:bg-slate-950/45 shadow-sm';
    
    $paddingClass = $size === 'sm' ? 'px-3 py-2' : 'px-4 py-3';
    $roundedClass = $size === 'sm' ? 'rounded-xl' : 'rounded-2xl';
    
    $baseInputClass = "w-full $paddingClass border $roundedClass text-sm dark:text-white outline-none transition-all duration-300 placeholder:text-slate-400 dark:placeholder:text-slate-600 " . $bgClass . " " . $errorClass;
    $selectedState = filled($selectedExpression) ? $selectedExpression : \Illuminate\Support\Js::from((string) old($name, $value));
@endphp

<div class="space-y-2 group">
    @if ($label && $type !== 'toggle')
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
                if (is_object($optLabel) || is_array($optLabel)) {
                    $optionValue = filled($optionValueKey)
                        ? data_get($optLabel, $optionValueKey)
                        : data_get($optLabel, 'id', $optVal);
                    $optionLabel = filled($optionLabelKey)
                        ? data_get($optLabel, $optionLabelKey)
                        : (data_get($optLabel, 'display_label')
                            ?? data_get($optLabel, 'name')
                            ?? data_get($optLabel, 'title')
                            ?? data_get($optLabel, 'label')
                            ?? $optionValue);
                } else {
                    $optionValue = $optVal;
                    $optionLabel = $optLabel;
                }

                $formattedOptions[] = [
                    'value' => (string) $optionValue,
                    'label' => (string) $optionLabel,
                ];
            }
        @endphp
        <div x-data="{
            open: false,
            search: '',
            selected: {!! $selectedState !!},
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
        }"
            x-init="
                @if (filled($modelExpression))
                    if (selected && {!! $modelExpression !!} !== selected) {!! $modelExpression !!} = selected;
                @endif
                $watch('selected', value => {
                    @if (filled($modelExpression))
                        {!! $modelExpression !!} = value;
                    @endif
                    $refs.button.dispatchEvent(new Event('change', { bubbles: true }));
                });
            "
            class="relative" @click.away="open = false">
            <input type="hidden"
                @if (filled($nameExpression))
                    :name="{!! $nameExpression !!}"
                @else
                    name="{{ $name }}"
                @endif
                :value="selected" {{ $required ? 'required' : '' }} {{ $attributes->whereStartsWith('data-') }}>
            
            <button x-ref="button" type="button" @click="open = !open"
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
        <div class="richtext-wrapper relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950/50 backdrop-blur-sm transition-all duration-300 focus-within:border-primary focus-within:ring-4 focus-within:ring-primary/10">
            <input id="{{ $name }}_hidden" type="hidden" name="{{ $name }}" value="{{ old($name, $value) }}">
            <script id="{{ $name }}_initial" type="application/json">@json(old($name, $value))</script>
            <div id="{{ $name }}_editor" class="quill-editor bg-white dark:bg-slate-950/50" data-name="{{ $name }}"
                data-placeholder="{{ $placeholder }}"></div>
        </div>
        <x-molecules.shared.modal id="{{ $name }}_link_modal" title="Atur Link" maxWidth="md">
            <div
                x-data="{
                    editorName: @js($name),
                    url: '',
                    text: '',
                    hasExisting: false,
                    init() {
                        window.addEventListener('open-richtext-link-modal', (event) => {
                            if (event.detail.name !== this.editorName) return;
                            this.url = event.detail.url || '';
                            this.text = event.detail.text || '';
                            this.hasExisting = !!event.detail.hasExisting;
                            this.$nextTick(() => this.$refs.urlInput?.focus());
                        });
                    },
                    save() {
                        window.richTextEditors?.[this.editorName]?.applyLink(this.url, this.text);
                        window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: this.editorName + '_link_modal' } }));
                    },
                    remove() {
                        window.richTextEditors?.[this.editorName]?.removeLink();
                        window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: this.editorName + '_link_modal' } }));
                    },
                }"
                class="space-y-6"
            >
                <div class="space-y-2">
                    <label class="inline-block text-sm font-bold text-slate-700 dark:text-slate-300">Teks Link</label>
                    <x-atoms.shared.input type="text" x-model="text" placeholder="Teks yang tampil..." />
                </div>

                <div class="space-y-2">
                    <label class="inline-block text-sm font-bold text-slate-700 dark:text-slate-300">URL</label>
                    <x-atoms.shared.input type="url" x-model="url" x-ref="urlInput" placeholder="https://..." />
                </div>

                <div class="flex justify-end pt-2">
                    <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                        <button type="button"
                            x-show="hasExisting"
                            @click="remove"
                            class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-bold text-red-500/80 transition hover:bg-red-500/10 hover:text-red-500">
                            Hapus Link
                        </button>
                        <button type="button"
                            @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: editorName + '_link_modal' } }))"
                            class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-bold text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-800 dark:hover:text-slate-300">
                            Batal
                        </button>
                        <button type="button"
                            @click="save"
                            class="inline-flex items-center justify-center rounded-xl border border-primary/20 bg-primary/5 px-5 py-2.5 text-sm font-bold text-primary transition hover:bg-primary/10 dark:bg-primary/10 dark:hover:bg-primary/20">
                            Simpan Link
                        </button>
                    </div>
                </div>
            </div>
        </x-molecules.shared.modal>
        <x-molecules.shared.modal id="{{ $name }}_media_modal" title="Atur Media" maxWidth="md">
            <div
                x-data="{
                    editorName: @js($name),
                    type: 'image',
                    source: 'url',
                    url: '',
                    isUploading: false,
                    hasExisting: false,
                    get label() {
                        return this.type === 'video' ? 'URL Video' : 'Sumber Gambar';
                    },
                    get placeholder() {
                        return this.type === 'video' ? 'https://youtube.com/...' : 'https://...';
                    },
                    init() {
                        window.addEventListener('open-richtext-media-modal', (event) => {
                            if (event.detail.name !== this.editorName) return;
                            this.type = event.detail.type || 'image';
                            this.source = 'url';
                            this.url = event.detail.url || '';
                            this.hasExisting = !!event.detail.hasExisting;
                            this.isUploading = false;
                            this.$nextTick(() => this.$refs.mediaUrlInput?.focus());
                        });
                    },
                    async save() {
                        if (this.type === 'image' && this.source === 'file') {
                            const fileInput = this.$refs.mediaFileInput;
                            if (fileInput && fileInput.files.length > 0) {
                                this.isUploading = true;
                                let formData = new FormData();
                                formData.append('image', fileInput.files[0]);
                                try {
                                    let csrfMeta = document.querySelector('meta[name=csrf-token]');
                                    let res = await fetch('/dashboard/editor/upload', {
                                        method: 'POST',
                                        headers: csrfMeta ? { 'X-CSRF-TOKEN': csrfMeta.content } : {},
                                        body: formData
                                    });
                                    let data = await res.json();
                                    if (data.url) {
                                        this.url = data.url;
                                    } else {
                                        alert('Gagal mengupload gambar: ' + (data.message || 'Unknown error'));
                                        this.isUploading = false;
                                        return;
                                    }
                                }
                                catch(e) {
                                    alert('Gagal menghubungi server untuk upload gambar. Pastikan endpoint /dashboard/editor/upload tersedia.');
                                    this.isUploading = false;
                                    return;
                                }
                                this.isUploading = false;
                            } else if (!this.url.trim()) {
                                alert('Pilih file gambar terlebih dahulu.');
                                return;
                            }
                        }

                        if (!this.url.trim()) {
                            alert(this.type === 'video' ? 'Masukkan URL video terlebih dahulu.' : 'Masukkan URL gambar terlebih dahulu.');
                            return;
                        }

                        window.richTextEditors?.[this.editorName]?.applyMedia(this.type, this.url);
                        window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: this.editorName + '_media_modal' } }));
                    },
                    remove() {
                        window.richTextEditors?.[this.editorName]?.removeMedia();
                        window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: this.editorName + '_media_modal' } }));
                    },
                }"
                class="space-y-6"
            >
                <div class="space-y-4">
                    <div class="flex items-center justify-between" x-show="type === 'image'">
                        <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Sumber Gambar</label>
                        <div class="inline-grid grid-cols-2 overflow-hidden rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-slate-100 dark:bg-slate-950/60 p-1">
                            <button type="button" @click="source = 'url'"
                                :class="source === 'url' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'"
                                class="rounded-xl px-4 py-1.5 text-[10px] font-black transition uppercase tracking-widest">URL</button>
                            <button type="button" @click="source = 'file'"
                                :class="source === 'file' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'"
                                class="rounded-xl px-4 py-1.5 text-[10px] font-black transition uppercase tracking-widest">File Lokal</button>
                        </div>
                    </div>

                    <div x-show="source === 'url' || type === 'video'" x-cloak class="space-y-2">
                        <label class="inline-block text-sm font-bold text-slate-700 dark:text-slate-300" x-text="type === 'video' ? 'URL Video' : 'URL Gambar'"></label>
                        <x-atoms.shared.input type="url" x-model="url" x-ref="mediaUrlInput" x-bind:placeholder="placeholder" />
                        <p class="text-xs text-slate-400 dark:text-slate-500">
                            Gunakan URL publik agar media dapat tampil di halaman.
                        </p>
                    </div>

                    <div x-show="type === 'image' && source === 'file'" x-cloak class="space-y-2">
                        <input type="file" x-ref="mediaFileInput" accept="image/*"
                            class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/5 dark:file:bg-primary/20 file:text-primary hover:file:bg-primary/10 transition cursor-pointer" />
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Gambar akan diunggah otomatis ke server.</p>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                        <button type="button"
                            x-show="hasExisting"
                            @click="remove"
                            :disabled="isUploading"
                            class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-bold text-red-500/80 transition hover:bg-red-500/10 hover:text-red-500 disabled:opacity-50">
                            Hapus Media
                        </button>
                        <button type="button"
                            @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: editorName + '_media_modal' } }))"
                            :disabled="isUploading"
                            class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-bold text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-800 dark:hover:text-slate-300 disabled:opacity-50">
                            Batal
                        </button>
                        <button type="button"
                            @click="save"
                            :disabled="isUploading"
                            class="inline-flex items-center justify-center rounded-xl border border-primary/20 bg-primary/5 px-5 py-2.5 text-sm font-bold text-primary transition hover:bg-primary/10 dark:bg-primary/10 dark:hover:bg-primary/20 disabled:opacity-50">
                            <span x-show="!isUploading">Simpan Media</span>
                            <span x-show="isUploading">Mengunggah...</span>
                        </button>
                    </div>
                </div>
            </div>
        </x-molecules.shared.modal>
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
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            [{ 'size': ['small', false, 'large', 'huge'] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'script': 'sub' }, { 'script': 'super' }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'indent': '-1' }, { 'indent': '+1' }],
                            [{ 'align': [] }],
                            ['blockquote', 'code-block'],
                            ['link', 'image', 'video'],
                            ['clean']
                        ]
                    }
                });
                var toolbar = quill.getModule('toolbar');
                var editorName = '{{ $name }}';
                var savedRange = null;
                var currentLinkRange = null;
                var currentMediaRange = null;

                function normalizeMediaUrl(url) {
                    var cleanUrl = (url || '').trim();
                    if (!cleanUrl) return '';
                    if (/^(data:|blob:|\/\/)/i.test(cleanUrl)) return cleanUrl;

                    try {
                        var parsedUrl = new URL(cleanUrl.replace(/^\/+/, '/'), window.location.origin);
                        var localHosts = ['localhost', '127.0.0.1', '[::1]', '::1'];
                        var isLocalStorageUrl = parsedUrl.pathname.indexOf('/storage/') === 0
                            && localHosts.indexOf(parsedUrl.hostname) !== -1
                            && localHosts.indexOf(window.location.hostname) !== -1;

                        if (isLocalStorageUrl && parsedUrl.origin !== window.location.origin) {
                            return window.location.origin + parsedUrl.pathname + parsedUrl.search + parsedUrl.hash;
                        }

                        return parsedUrl.href;
                    } catch (e) {
                        return cleanUrl;
                    }
                }

                function dataUrlToImageFile(dataUrl) {
                    var match = (dataUrl || '').match(/^data:(image\/[a-zA-Z0-9.+-]+);base64,(.+)$/);
                    if (!match) return null;

                    var mimeType = match[1];
                    var binary = atob(match[2]);
                    var bytes = new Uint8Array(binary.length);
                    for (var i = 0; i < binary.length; i++) {
                        bytes[i] = binary.charCodeAt(i);
                    }

                    var extension = (mimeType.split('/')[1] || 'png').replace('jpeg', 'jpg');
                    return new File([bytes], 'pasted-image.' + extension, { type: mimeType });
                }

                function getClipboardImageFile(clipboardData) {
                    if (!clipboardData) return null;

                    if (clipboardData.files && clipboardData.files.length) {
                        for (var i = 0; i < clipboardData.files.length; i++) {
                            if (clipboardData.files[i].type.indexOf('image') === 0) {
                                return clipboardData.files[i];
                            }
                        }
                    }

                    if (clipboardData.items && clipboardData.items.length) {
                        for (var j = 0; j < clipboardData.items.length; j++) {
                            var item = clipboardData.items[j];
                            if (item.type.indexOf('image') === 0) {
                                var itemFile = item.getAsFile();
                                if (itemFile) return itemFile;
                            }
                        }
                    }

                    var html = clipboardData.getData ? clipboardData.getData('text/html') : '';
                    var imageMatch = html.match(/<img[^>]+src=["'](data:image\/[^"']+)["']/i);
                    var dataUrl = imageMatch ? imageMatch[1] : '';
                    return dataUrlToImageFile(dataUrl);
                }

                function compressPastedImage(file) {
                    if (!file || file.size <= 1900 * 1024) {
                        return Promise.resolve(file);
                    }

                    return new Promise(function(resolve) {
                        var image = new Image();
                        var objectUrl = URL.createObjectURL(file);

                        image.onload = function() {
                            var maxDimension = 1600;
                            var scale = Math.min(1, maxDimension / image.width, maxDimension / image.height);
                            var canvas = document.createElement('canvas');
                            canvas.width = Math.max(1, Math.round(image.width * scale));
                            canvas.height = Math.max(1, Math.round(image.height * scale));

                            var context = canvas.getContext('2d');
                            context.drawImage(image, 0, 0, canvas.width, canvas.height);

                            canvas.toBlob(function(blob) {
                                URL.revokeObjectURL(objectUrl);
                                if (!blob) {
                                    resolve(file);
                                    return;
                                }

                                resolve(new File([blob], 'pasted-image.jpg', { type: 'image/jpeg' }));
                            }, 'image/jpeg', 0.82);
                        };

                        image.onerror = function() {
                            URL.revokeObjectURL(objectUrl);
                            resolve(file);
                        };

                        image.src = objectUrl;
                    });
                }

                function removeClipboardImageArtifacts() {
                    quill.root.querySelectorAll('img').forEach(function(image) {
                        var src = image.getAttribute('src') || '';
                        if (!src || src.indexOf('data:image/') === 0 || src.indexOf('blob:') === 0) {
                            var blot = Quill.find(image);
                            if (!blot) {
                                image.remove();
                                return;
                            }

                            var index = quill.getIndex(blot);
                            quill.deleteText(index, 1, 'silent');
                        }
                    });
                    hiddenInput.value = quill.root.innerHTML;
                }

                function openLinkModal() {
                    var range = quill.getSelection(true);
                    if (!range) return;

                    var format = quill.getFormat(range);
                    if (!range.length && !format.link) {
                        if (typeof window.toast === 'function') {
                            window.toast('Blok teks terlebih dahulu sebelum menambahkan link.', 'warning');
                        } else {
                            window.dispatchEvent(new CustomEvent('toast', {
                                detail: {
                                    message: 'Blok teks terlebih dahulu sebelum menambahkan link.',
                                    type: 'warning'
                                }
                            }));
                        }
                        return;
                    }

                    var text = range.length ? quill.getText(range.index, range.length) : '';
                    savedRange = range;
                    currentLinkRange = range.length ? range : null;

                    window.dispatchEvent(new CustomEvent('open-richtext-link-modal', {
                        detail: {
                            name: editorName,
                            url: format.link || '',
                            text: text.trim(),
                            hasExisting: !!format.link
                        }
                    }));
                    window.dispatchEvent(new CustomEvent('open-modal', {
                        detail: { name: editorName + '_link_modal' }
                    }));
                }

                function openMediaModal(type, url, existingRange) {
                    var range = quill.getSelection(true);
                    if (!range) return;

                    savedRange = range;
                    currentMediaRange = existingRange || null;

                    window.dispatchEvent(new CustomEvent('open-richtext-media-modal', {
                        detail: {
                            name: editorName,
                            type: type,
                            url: url || '',
                            hasExisting: !!url
                        }
                    }));
                    window.dispatchEvent(new CustomEvent('open-modal', {
                        detail: { name: editorName + '_media_modal' }
                    }));
                }

                if (toolbar) {
                    toolbar.addHandler('link', openLinkModal);
                    toolbar.addHandler('image', function() {
                        openMediaModal('image');
                    });
                    toolbar.addHandler('video', function() {
                        openMediaModal('video');
                    });
                }

                container.addEventListener('click', function(event) {
                    var link = event.target.closest('a');
                    var image = event.target.closest('img');
                    var video = event.target.closest('iframe');

                    if (link && container.contains(link)) {
                        event.preventDefault();
                        var linkBlot = Quill.find(link);
                        var linkIndex = quill.getIndex(linkBlot);
                        var linkLength = linkBlot.length();
                        quill.setSelection(linkIndex, linkLength, 'user');
                        savedRange = { index: linkIndex, length: linkLength };
                        currentLinkRange = savedRange;

                        window.dispatchEvent(new CustomEvent('open-richtext-link-modal', {
                            detail: {
                                name: editorName,
                                url: link.getAttribute('href') || '',
                                text: link.textContent.trim(),
                                hasExisting: true
                            }
                        }));
                        window.dispatchEvent(new CustomEvent('open-modal', {
                            detail: { name: editorName + '_link_modal' }
                        }));
                        return;
                    }

                    if (image && container.contains(image)) {
                        event.preventDefault();
                        var imageBlot = Quill.find(image);
                        var imageIndex = quill.getIndex(imageBlot);
                        quill.setSelection(imageIndex, 1, 'user');
                        savedRange = { index: imageIndex, length: 1 };
                        currentMediaRange = savedRange;
                        openMediaModal('image', image.getAttribute('src') || '', savedRange);
                        return;
                    }

                    if (video && container.contains(video)) {
                        event.preventDefault();
                        var videoBlot = Quill.find(video);
                        var videoIndex = quill.getIndex(videoBlot);
                        quill.setSelection(videoIndex, 1, 'user');
                        savedRange = { index: videoIndex, length: 1 };
                        currentMediaRange = savedRange;
                        openMediaModal('video', video.getAttribute('src') || '', savedRange);
                    }
                });

                window.richTextEditors = window.richTextEditors || {};
                window.richTextEditors[editorName] = {
                    applyLink: function(url, text) {
                        var cleanUrl = (url || '').trim();
                        var cleanText = (text || '').trim();
                        var range = savedRange || quill.getSelection(true);

                        if (!range) return;
                        quill.focus();
                        quill.setSelection(range.index, range.length, 'silent');

                        if (!cleanUrl) {
                            this.removeLink();
                            return;
                        }

                        if (cleanText && range.length) {
                            quill.deleteText(range.index, range.length, 'user');
                            quill.insertText(range.index, cleanText, { link: cleanUrl }, 'user');
                            quill.setSelection(range.index + cleanText.length, 0, 'silent');
                        } else if (cleanText) {
                            quill.insertText(range.index, cleanText, { link: cleanUrl }, 'user');
                            quill.setSelection(range.index + cleanText.length, 0, 'silent');
                        } else {
                            quill.format('link', cleanUrl, 'user');
                        }

                        hiddenInput.value = quill.root.innerHTML;
                    },
                    removeLink: function() {
                        var range = currentLinkRange || savedRange || quill.getSelection(true);
                        if (!range) return;

                        quill.focus();
                        if (range.length) {
                            quill.formatText(range.index, range.length, 'link', false, 'user');
                        } else {
                            quill.format('link', false, 'user');
                        }
                        hiddenInput.value = quill.root.innerHTML;
                    },
                    applyMedia: function(type, url) {
                        var cleanUrl = normalizeMediaUrl(url);
                        var mediaType = type === 'video' ? 'video' : 'image';
                        var range = currentMediaRange || savedRange || quill.getSelection(true);

                        if (!range) return;
                        quill.focus();

                        if (!cleanUrl) {
                            this.removeMedia();
                            return;
                        }

                        if (range.length) {
                            quill.deleteText(range.index, range.length, 'user');
                        }

                        quill.insertEmbed(range.index, mediaType, cleanUrl, 'user');
                        quill.setSelection(range.index + 1, 0, 'silent');
                        hiddenInput.value = quill.root.innerHTML;
                    },
                    removeMedia: function() {
                        var range = currentMediaRange;
                        if (!range) return;

                        quill.focus();
                        quill.deleteText(range.index, 1, 'user');
                        hiddenInput.value = quill.root.innerHTML;
                    }
                };
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

                // Intercept image paste on the editor container before Quill inserts temporary/base64 image nodes.
                container.addEventListener('paste', async function(e) {
                    var clipboardData = e.clipboardData || window.clipboardData;
                    if (!clipboardData) return;

                    var file = getClipboardImageFile(clipboardData);
                    
                    if (file) {
                        e.preventDefault();
                        e.stopPropagation();
                        e.stopImmediatePropagation();
                        removeClipboardImageArtifacts();

                        var uploadFile = await compressPastedImage(file);

                        if (uploadFile.size > 2048 * 1024) {
                            alert('Ukuran gambar paste maksimal 2MB. Kompres gambar terlebih dahulu atau upload gambar yang lebih kecil.');
                            return;
                        }

                        var range = quill.getSelection(true) || { index: quill.getLength(), length: 0 };
                        var formData = new FormData();
                        formData.append('image', uploadFile);
                        
                        try {
                            let csrfMeta = document.querySelector('meta[name=csrf-token]');
                            var res = await fetch('/dashboard/editor/upload', {
                                method: 'POST',
                                headers: csrfMeta ? { 'X-CSRF-TOKEN': csrfMeta.content } : {},
                                body: formData
                            });
                            var data = await res.json();
                            
                            if (res.ok && data.url) {
                                removeClipboardImageArtifacts();
                                quill.insertEmbed(range ? range.index : 0, 'image', normalizeMediaUrl(data.url), 'user');
                                quill.setSelection(range.index + 1, 0, 'silent');
                                hiddenInput.value = quill.root.innerHTML;
                            } else {
                                alert('Gagal mengupload gambar yang di-paste: ' + (data.message || 'Unknown error'));
                            }
                        } catch(err) {
                            alert('Gagal menghubungi server untuk upload gambar paste. Pastikan endpoint /dashboard/editor/upload tersedia.');
                        }
                    }
                }, true);
            });
        </script>
    @elseif ($type === 'toggle')
        <div class="flex items-center justify-between p-4 bg-slate-50/50 dark:bg-slate-900/30 border border-slate-100 dark:border-slate-800 rounded-2xl transition-all duration-300 hover:border-primary/20 hover:bg-primary/[0.02] dark:hover:bg-primary/[0.01] group/toggle-card">
            <div class="flex flex-col">
                <span class="text-sm font-bold text-slate-700 dark:text-slate-300 group-hover/toggle-card:text-primary transition-colors duration-300">{{ $label }}</span>
                @if ($placeholder)
                    <span class="text-[11px] text-slate-400 dark:text-slate-500 mt-0.5 leading-relaxed">{{ $placeholder }}</span>
                @elseif ($helper)
                    <span class="text-[11px] text-slate-400 dark:text-slate-500 mt-0.5 leading-relaxed">{{ $helper }}</span>
                @endif
            </div>
            <label class="relative inline-flex items-center cursor-pointer select-none">
                <input type="hidden" name="{{ $name }}" value="0" />
                <input type="checkbox" name="{{ $name }}" value="1" id="{{ $name }}"
                    class="peer sr-only"
                    {{ old($name, $value) ? 'checked' : '' }}
                    {{ $attributes }} />
                <div class="w-11 h-6 bg-slate-200 dark:bg-slate-800 rounded-full transition-colors duration-300 peer-checked:bg-primary shadow-inner"></div>
                <div class="absolute top-1 left-1 w-4 h-4 bg-white dark:bg-slate-100 rounded-full transition-transform duration-300 peer-checked:translate-x-5 shadow-md"></div>
            </label>
        </div>
    @elseif ($type === 'password')
        <div x-data="{ show: false }" class="relative flex items-center w-full">
            <input :type="show ? 'text' : 'password'" name="{{ $name }}" id="{{ $name }}"
                value="{{ old($name, $value) }}"
                placeholder="{{ $placeholder }}"
                class="{{ $baseInputClass }} pr-12"
                {{ $required ? 'required' : '' }}
                {{ $attributes }} />
            <button type="button" @click="show = !show"
                class="absolute right-4 text-slate-400 hover:text-primary transition-colors duration-200">
                <span x-show="!show"><x-heroicon-o-eye class="size-5" /></span>
                <span x-show="show" style="display: none;"><x-heroicon-o-eye-slash class="size-5" /></span>
            </button>
        </div>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            class="{{ $baseInputClass }}"
            {{ $required ? 'required' : '' }}
            @if($type === 'number') min="0" onkeydown="if(event.key === '-') event.preventDefault()" @endif
            {{ $attributes }} />
    @endif

    @if ($helper && $type !== 'toggle')
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
