<div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="slugHelper(@js(old('name', $product?->name)), @js(old('slug', $product?->slug)))">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Product Details --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-shopping-bag class="size-32" />
            </div>
            
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary flex items-center justify-center">
                    <x-heroicon-s-cube class="size-5" />
                </span>
                Informasi Produk
            </h3>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input 
                        label="Nama Produk" 
                        name="name" 
                        placeholder="Contoh: Hoodie HMTIF 2024"
                        :value="$product?->name ?? ''" 
                        required 
                        x-model="sourceValue" />

                    <x-molecules.shared.forms.form-input 
                        label="Slug" 
                        name="slug" 
                        placeholder="dibuat otomatis"
                        :value="$product?->slug ?? ''" 
                        required 
                        x-model="slugValue" 
                        readonly />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-molecules.shared.forms.form-input 
                        label="Harga (Rp)" 
                        name="price" 
                        type="number"
                        placeholder="0"
                        :value="$product?->price ?? ''" 
                        required />
                    
                    <x-molecules.shared.forms.form-input 
                        label="No. WhatsApp Pemesanan" 
                        name="phone_number" 
                        placeholder="628123456789"
                        :value="$product?->phone_number ?? ''" 
                        helper="Format: 628..." />
                </div>

                <x-molecules.shared.forms.form-input 
                    label="Deskripsi Produk" 
                    name="description" 
                    type="richtext"
                    placeholder="Tuliskan spesifikasi produk, bahan, ukuran, dll..."
                    :value="$product?->description ?? ''" />

                <x-molecules.shared.forms.form-input 
                    label="Cara Pemesanan (Otomatis muncul di WhatsApp)" 
                    name="order_text" 
                    type="textarea"
                    placeholder="Halo Admin, saya ingin memesan produk..."
                    :value="$product?->order_text ?? ''" 
                    :rows="3" />
            </div>
        </div>

        {{-- Product Images --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                <span class="size-8 rounded-xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-500 flex items-center justify-center">
                    <x-heroicon-s-photo class="size-5" />
                </span>
                Gambar Produk
            </h3>

            @php
                $imageCount = $product?->images?->count() ?? 0;
            @endphp

            <div id="imageRepeater" class="space-y-4 mb-6" data-count="{{ max($imageCount, 1) }}">
                @if ($imageCount === 0)
                    <div class="image-row rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950/40 p-4 shadow-sm transition hover:border-primary/20 dark:hover:border-primary/30"
                        x-data="{ source: 'url' }">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-4 xl:flex-row xl:items-start xl:justify-between">
                                <div class="space-y-2">
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Sumber Gambar</label>
                                    <div class="inline-grid grid-cols-2 overflow-hidden rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-slate-100 dark:bg-slate-950/60 p-1">
                                        <button type="button" @click="source = 'url'"
                                            :class="source === 'url' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'"
                                            class="rounded-xl px-5 py-2 text-xs font-bold transition">URL</button>
                                        <button type="button" @click="source = 'file'"
                                            :class="source === 'file' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'"
                                            class="rounded-xl px-5 py-2 text-xs font-bold transition">File</button>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-end gap-4 xl:justify-end">
                                    <div class="w-28">
                                        <x-molecules.shared.forms.form-input 
                                            label="Urutan Tampil"
                                            name="images[0][order]"
                                            type="number"
                                            value="0"
                                        />
                                    </div>

                                    <div class="pb-3">
                                        <x-atoms.shared.checkbox 
                                            name="images[0][is_primary]" 
                                            value="1"
                                            label="Utama"
                                        />
                                    </div>
    
                                    <x-atoms.shared.button 
                                        variant="ghost"
                                        type="button"
                                        onclick="this.closest('.image-row').remove()"
                                        class="mb-2 size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10">
                                        <x-heroicon-o-trash class="size-4" />
                                    </x-atoms.shared.button>
                                </div>
                            </div>

                            <div x-show="source === 'url'" x-cloak>
                                <x-molecules.shared.forms.form-input 
                                    label="URL / Path Gambar"
                                    name="images[0][image_path]"
                                    placeholder="https://..."
                                />
                            </div>

                            <div x-show="source === 'file'" x-cloak class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">File Lokal</label>
                                <input type="file"
                                    accept="image/*"
                                    class="w-full rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-white dark:bg-slate-950/45 px-4 py-3 text-sm text-slate-500 dark:text-slate-400 file:mr-3 file:rounded-xl file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-xs file:font-black file:uppercase file:text-primary hover:file:bg-primary/20 transition" />
                            </div>
                        </div>
                    </div>
                @endif

                @foreach ($product?->images ?? [] as $i => $img)
                    <div class="image-row rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950/40 p-4 shadow-sm transition hover:border-primary/20 dark:hover:border-primary/30"
                        x-data="{ source: 'url' }">
                        <input type="hidden" name="images[{{ $i }}][id]" value="{{ $img->id }}" />

                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-4 xl:flex-row xl:items-start xl:justify-between">
                                <div class="space-y-2">
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Sumber Gambar</label>
                                    <div class="inline-grid grid-cols-2 overflow-hidden rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-slate-100 dark:bg-slate-950/60 p-1">
                                        <button type="button" @click="source = 'url'"
                                            :class="source === 'url' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'"
                                            class="rounded-xl px-5 py-2 text-xs font-bold transition">URL</button>
                                        <button type="button" @click="source = 'file'"
                                            :class="source === 'file' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'"
                                            class="rounded-xl px-5 py-2 text-xs font-bold transition">File</button>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-end gap-4 xl:justify-end">
                                    <div class="w-28">
                                        <x-molecules.shared.forms.form-input 
                                            label="Urutan Tampil"
                                            name="images[{{ $i }}][order]"
                                            type="number"
                                            :value="$img->order"
                                        />
                                    </div>
    
                                    <div class="pb-3">
                                        <x-atoms.shared.checkbox 
                                            name="images[{{ $i }}][is_primary]" 
                                            value="1"
                                            :checked="$img->is_primary"
                                            label="Utama"
                                        />
                                    </div>
    
                                    <x-atoms.shared.button 
                                        variant="ghost"
                                        type="button"
                                        onclick="this.closest('.image-row').remove()"
                                        class="mb-2 size-9 !px-0 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10">
                                        <x-heroicon-o-trash class="size-4" />
                                    </x-atoms.shared.button>
                                </div>
                            </div>

                            <div x-show="source === 'url'" x-cloak>
                                <x-molecules.shared.forms.form-input 
                                    label="URL / Path Gambar"
                                    name="images[{{ $i }}][image_path]"
                                    :value="$img->image_path"
                                    placeholder="https://..."
                                />
                            </div>

                            <div x-show="source === 'file'" x-cloak class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">File Lokal</label>
                                <input type="file"
                                    accept="image/*"
                                    class="w-full rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-white dark:bg-slate-950/45 px-4 py-3 text-sm text-slate-500 dark:text-slate-400 file:mr-3 file:rounded-xl file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-xs file:font-black file:uppercase file:text-primary hover:file:bg-primary/20 transition" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <x-atoms.shared.button 
                variant="soft"
                type="button"
                onclick="addImageRow()"
                icon="heroicon-o-plus-circle"
                class="w-full border border-primary/20 border-dashed py-4">
                Tambah Gambar Baru
            </x-atoms.shared.button>

            <div class="mt-6 rounded-2xl border border-indigo-500/20 bg-indigo-500/5 p-5 dark:bg-indigo-500/10">
                <div class="flex gap-4">
                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-indigo-500/15 text-indigo-500 dark:bg-indigo-500/20">
                        <x-heroicon-s-information-circle class="size-5" />
                    </div>
                    <div>
                        <h4 class="mb-1 text-xs font-black uppercase tracking-widest text-indigo-500">Informasi Gambar</h4>
                        <p class="text-[11px] font-medium leading-relaxed text-slate-600 dark:text-slate-400">
                            Gunakan <strong>Utama</strong> untuk gambar cover produk. <strong>Urutan Tampil</strong> menentukan posisi gambar di galeri, mulai dari 0 sebagai gambar paling awal.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar Content --}}
    <div class="space-y-8">
        {{-- Category & Stock --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden transition-colors duration-300">
            <div class="absolute top-0 right-0 p-6 opacity-[0.03] text-primary pointer-events-none">
                <x-heroicon-o-tag class="size-24" />
            </div>
            
            <h3 class="text-xs font-black text-slate-800 dark:text-white mb-6 uppercase tracking-widest">Kategori & Stok</h3>
            
            <div class="space-y-6">
                <x-molecules.shared.forms.form-input 
                    label="Kategori Produk" 
                    name="product_category_id" 
                    type="select"
                    :value="$product?->product_category_id ?? ''" 
                    :options="$categories ?? []"
                    required />

                <div class="space-y-4 pt-4 border-t border-slate-50 dark:border-slate-800">
                    <x-molecules.shared.forms.form-input 
                        type="toggle" 
                        label="Produk Tersedia"
                        name="is_available" 
                        :value="$product?->is_available ?? true" />
                    
                    <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium italic leading-relaxed">
                        Jika produk ditandai sebagai **tidak tersedia**, produk akan tetap muncul di katalog namun tombol pemesanan akan dinonaktifkan.
                    </p>
                </div>
            </div>
        </div>

        {{-- Help Card --}}
        <div class="bg-indigo-500/5 dark:bg-indigo-500/10 rounded-2xl p-6 border border-indigo-500/10 dark:border-indigo-500/20 transition-colors duration-300">
            <div class="flex gap-4">
                <div class="size-10 rounded-xl bg-indigo-500/10 dark:bg-indigo-500/20 text-indigo-500 flex items-center justify-center shrink-0">
                    <x-heroicon-s-information-circle class="size-5" />
                </div>
                <div>
                    <h4 class="text-xs font-black text-indigo-500 uppercase tracking-widest mb-1">Informasi</h4>
                    <p class="text-[11px] text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        Gunakan **Slug** yang unik untuk setiap produk. Slug digunakan sebagai bagian dari URL produk Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function addImageRow() {
        const repeater = document.getElementById('imageRepeater');
        const count = parseInt(repeater.dataset.count);
        
        const html = `
            <div class="image-row rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950/40 p-4 shadow-sm transition hover:border-primary/20 dark:hover:border-primary/30 animate-in fade-in slide-in-from-top-2 duration-300"
                x-data="{ source: 'url' }">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-4 xl:flex-row xl:items-start xl:justify-between">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Sumber Gambar</label>
                            <div class="inline-grid grid-cols-2 overflow-hidden rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-slate-100 dark:bg-slate-950/60 p-1">
                                <button type="button" @click="source = 'url'"
                                    :class="source === 'url' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'"
                                    class="rounded-xl px-5 py-2 text-xs font-bold transition">URL</button>
                                <button type="button" @click="source = 'file'"
                                    :class="source === 'file' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'"
                                    class="rounded-xl px-5 py-2 text-xs font-bold transition">File</button>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-end gap-4 xl:justify-end">
                            <div class="space-y-1.5 w-28">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors duration-300">Urutan Tampil</label>
                                <input type="number" name="images[\${count}][order]" value="0" min="0" onkeydown="if(event.key === '-') event.preventDefault()"
                                    class="w-full px-4 py-3 border border-slate-200/50 dark:border-slate-800/50 bg-white dark:bg-slate-950/45 rounded-2xl text-sm text-slate-700 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600 focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 shadow-sm">
                            </div>

                            <label class="inline-flex items-center gap-2.5 cursor-pointer group/cb pb-3">
                                <div class="relative flex items-center justify-center">
                                    <input type="checkbox" name="images[\${count}][is_primary]" value="1"
                                        class="peer appearance-none size-5 rounded-lg border-2 border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 checked:bg-primary checked:border-primary transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-primary/10" />
                                    <svg class="absolute size-3 text-white scale-50 opacity-0 peer-checked:scale-100 peer-checked:opacity-100 transition-all duration-300 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 group-hover/cb:text-slate-900 dark:group-hover/cb:text-slate-200 transition-colors duration-300">Utama</span>
                            </label>

                            <button type="button" onclick="this.closest('.image-row').remove()"
                                class="mb-2 size-9 flex items-center justify-center text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition shadow-sm bg-white dark:bg-slate-950/45 border border-slate-200/50 dark:border-slate-800/50 active:scale-95 group/btn">
                                <svg class="size-4 transition-transform group-hover/btn:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </div>

                    <div x-show="source === 'url'" x-cloak class="space-y-1.5">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors duration-300">URL / Path Gambar</label>
                        <input type="text" name="images[\${count}][image_path]" placeholder="https://..."
                            class="w-full px-4 py-3 border border-slate-200/50 dark:border-slate-800/50 bg-white dark:bg-slate-950/45 rounded-2xl text-sm text-slate-700 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600 focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 shadow-sm">
                    </div>

                    <div x-show="source === 'file'" x-cloak class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">File Lokal</label>
                        <input type="file" accept="image/*"
                            class="w-full rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-white dark:bg-slate-950/45 px-4 py-3 text-sm text-slate-500 dark:text-slate-400 file:mr-3 file:rounded-xl file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-xs file:font-black file:uppercase file:text-primary hover:file:bg-primary/20 transition">
                    </div>
                </div>
            </div>
        `;
        
        repeater.insertAdjacentHTML('beforeend', html);
        repeater.dataset.count = count + 1;
        window.Alpine?.initTree(repeater.lastElementChild);
    }
</script>
@endpush
