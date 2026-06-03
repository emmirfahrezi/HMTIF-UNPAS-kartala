<div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="slugHelper(@js(old('name', $product?->name)), @js(old('slug', $product?->slug)))">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Product Details --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
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

                <div class="space-y-4">
                    <x-molecules.shared.forms.form-input 
                        label="Pesan Otomatis WhatsApp" 
                        name="order_text" 
                        type="textarea"
                        placeholder="Halo HMTIF Store, saya mau pesan [PRODUCT_NAME] ukuran [SIZE]."
                        :value="$product?->order_text ?? ''" 
                        :rows="3" />

                    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-5 dark:bg-emerald-500/10">
                        <div class="flex gap-4">
                            <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-emerald-500/15 text-emerald-500 dark:bg-emerald-500/20">
                                <x-heroicon-s-chat-bubble-left-ellipsis class="size-5" />
                            </div>
                            <div>
                                <h4 class="mb-1 text-xs font-black uppercase tracking-widest text-emerald-500">TIPS PESAN DINAMIS</h4>
                                <p class="text-[11px] font-medium leading-relaxed text-slate-600 dark:text-slate-400 mb-2">
                                    Gunakan tag di bawah ini untuk membuat format pesan otomatis yang dinamis menyesuaikan pesanan pembeli:
                                </p>
                                <ul class="text-[11px] font-medium leading-relaxed text-slate-600 dark:text-slate-400 list-disc pl-4 space-y-1">
                                    <li><strong>[PRODUCT_NAME]</strong> : Otomatis diganti menjadi nama produk ini.</li>
                                    <li><strong>[SIZE]</strong> : Otomatis diganti menjadi ukuran yang dipilih pembeli.</li>
                                    <li><strong>[PRICE]</strong> : Otomatis menampilkan harga produk (contoh: Rp 150.000).</li>
                                    <li><strong>[PRODUCT_LINK]</strong> : Otomatis menyisipkan link halaman produk ini.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Images --}}
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
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
                    <div class="image-row rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950/40 p-4 shadow-sm transition hover:border-primary/20 dark:hover:border-primary/30">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-wrap items-end justify-end gap-4">
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
                            <x-molecules.shared.forms.image-picker
                                label="Foto Produk"
                                name="images[0][image_path]"
                                file-name="images[0][image_file]"
                                helper="Pilih link gambar atau upload dari device. Format: JPG, JPEG, PNG. Maks. 2MB." />
                        </div>
                    </div>
                @endif

                @foreach ($product?->images ?? [] as $i => $img)
                    <div class="image-row rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950/40 p-4 shadow-sm transition hover:border-primary/20 dark:hover:border-primary/30">
                        <input type="hidden" name="images[{{ $i }}][id]" value="{{ $img->id }}" />

                        <div class="flex flex-col gap-4">
                            <div class="flex flex-wrap items-end justify-end gap-4">
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

                            <x-molecules.shared.forms.image-picker
                                label="Foto Produk"
                                name="images[{{ $i }}][image_path]"
                                file-name="images[{{ $i }}][image_file]"
                                :value="$img->image_path"
                                helper="Pilih link gambar atau upload dari device. Format: JPG, JPEG, PNG. Maks. 2MB. Kosongkan jika tidak ingin mengubah." />
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

            <template id="productImageRowTemplate">
                <div class="image-row rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950/40 p-4 shadow-sm transition hover:border-primary/20 dark:hover:border-primary/30 animate-in fade-in slide-in-from-top-2 duration-300">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-wrap items-end justify-end gap-4">
                            <div class="w-28">
                                <x-molecules.shared.forms.form-input
                                    label="Urutan Tampil"
                                    name="images[__INDEX__][order]"
                                    type="number"
                                    value="0"
                                />
                            </div>
                            <div class="pb-3">
                                <x-atoms.shared.checkbox
                                    name="images[__INDEX__][is_primary]"
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
                        <x-molecules.shared.forms.image-picker
                            label="Foto Produk"
                            name="images[__INDEX__][image_path]"
                            file-name="images[__INDEX__][image_file]"
                            helper="Pilih link gambar atau upload dari device. Format: JPG, JPEG, PNG. Maks. 2MB." />
                    </div>
                </div>
            </template>

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
        <div class="bg-white dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative transition-colors duration-300">
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
        const template = document.getElementById('productImageRowTemplate');
        const count = parseInt(repeater.dataset.count);

        const html = template.innerHTML.replaceAll('__INDEX__', count);
        repeater.insertAdjacentHTML('beforeend', html);
        repeater.dataset.count = count + 1;
        window.Alpine?.initTree(repeater.lastElementChild);
    }

    function ensureProductImagePreview(input) {
        const file = input.files?.[0];
        const row = input.closest('.image-row');

        if (!file || !row) return;

        const alpinePicker = input.closest('[x-data]');
        if (alpinePicker?.querySelector('img[alt="Preview gambar"]')) {
            return;
        }

        let preview = row.querySelector('[data-product-image-preview]');

        if (!preview) {
            preview = document.createElement('div');
            preview.dataset.productImagePreview = 'true';
            preview.className = 'flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3 dark:border-slate-800 dark:bg-slate-800';
            preview.innerHTML = `
                <img class="size-12 shrink-0 rounded-lg object-cover" alt="Preview gambar">
                <div class="min-w-0">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Preview</p>
                    <p class="truncate text-[11px] font-medium text-slate-500 dark:text-slate-400"></p>
                </div>
            `;
            (input.closest('.space-y-2') || row).appendChild(preview);
        }

        const image = preview.querySelector('img');
        const text = preview.querySelector('p:last-child');

        image.src = URL.createObjectURL(file);
        text.textContent = `File lokal dipilih: ${file.name}`;
    }

    document.addEventListener('change', (event) => {
        if (!event.target.matches('#imageRepeater input[type="file"][name*="[image_file]"]')) {
            return;
        }

        ensureProductImagePreview(event.target);
    });
</script>
@endpush
