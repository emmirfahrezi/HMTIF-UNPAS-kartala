{{-- Shared Product Form --}}
<div class="space-y-6 max-w-4xl">
    <x-dashboard.form-section title="Informasi Produk">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <x-dashboard.form-input label="Nama Produk" name="name" :value="$product?->name" placeholder="Nama produk" required />
            <x-dashboard.form-input label="Slug" name="slug" :value="$product?->slug" placeholder="auto-generated" required />
            <x-dashboard.form-input type="select" label="Kategori" name="product_category_id" :value="$product?->product_category_id"
                :options="$categories ?? []" />
            <x-dashboard.form-input type="number" label="Harga" name="price" :value="$product?->price" placeholder="0" required />
        </div>
        <x-dashboard.form-input label="No. Telepon Pemesanan" name="phone_number" :value="$product?->phone_number" placeholder="+6281234567890" />
        <x-dashboard.form-input type="toggle" name="is_available" :value="$product?->is_available ?? true" placeholder="Produk tersedia" />
        <x-dashboard.form-input type="textarea" label="Deskripsi" name="description" :value="$product?->description" :rows="4" />
        <x-dashboard.form-input type="textarea" label="Teks Cara Order" name="order_text" :value="$product?->order_text" :rows="4"
            placeholder="Contoh: Hubungi admin via WhatsApp..." />
    </x-dashboard.form-section>

    <x-dashboard.form-section title="Gambar Produk" description="Tambah atau kelola gambar produk. Gambar pertama secara default menjadi gambar utama.">
        <div id="imageRepeater" class="space-y-3">
            @foreach ($product?->images ?? [] as $i => $img)
                <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl border border-slate-200 image-row">
                    <input type="hidden" name="images[{{ $i }}][id]" value="{{ $img->id }}" />
                    <input type="text" name="images[{{ $i }}][image_path]" value="{{ $img->image_path }}"
                        placeholder="Path / URL gambar"
                        class="flex-1 px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
                    <input type="number" name="images[{{ $i }}][order]" value="{{ $img->order }}"
                        placeholder="Urutan" class="w-20 px-3 py-2.5 border border-slate-200 rounded-xl text-sm text-center focus:outline-none focus:ring-2 focus:ring-primary/20" />
                    <label class="flex items-center gap-1.5 text-xs text-slate-500 shrink-0">
                        <input type="checkbox" name="images[{{ $i }}][is_primary]" value="1"
                            {{ $img->is_primary ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary" />
                        Utama
                    </label>
                    <button type="button" onclick="this.closest('.image-row').remove()"
                        class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition shrink-0">
                        <x-heroicon-o-x-mark class="size-4" />
                    </button>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addImageRow()"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-primary bg-primary/10 rounded-xl hover:bg-primary/20 transition">
            <x-heroicon-o-plus class="size-4" /> Tambah Gambar
        </button>
    </x-dashboard.form-section>

    <div class="flex items-center gap-3">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">
            {{ $product ? 'Simpan Perubahan' : 'Tambah Produk' }}
        </button>
        <a href="/dashboard/products" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
    </div>
</div>

<script>
    let imageIndex = {{ ($product?->images?->count() ?? 0) }};
    function addImageRow() {
        const container = document.getElementById('imageRepeater');
        const row = document.createElement('div');
        row.className = 'flex items-center gap-3 p-4 bg-slate-50 rounded-xl border border-slate-200 image-row';
        row.innerHTML = `
            <input type="text" name="images[${imageIndex}][image_path]" placeholder="Path / URL gambar"
                class="flex-1 px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
            <input type="number" name="images[${imageIndex}][order]" value="0" placeholder="Urutan"
                class="w-20 px-3 py-2.5 border border-slate-200 rounded-xl text-sm text-center focus:outline-none focus:ring-2 focus:ring-primary/20" />
            <label class="flex items-center gap-1.5 text-xs text-slate-500 shrink-0">
                <input type="checkbox" name="images[${imageIndex}][is_primary]" value="1"
                    class="rounded border-slate-300 text-primary focus:ring-primary" />
                Utama
            </label>
            <button type="button" onclick="this.closest('.image-row').remove()"
                class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition shrink-0">✕</button>
        `;
        container.appendChild(row);
        imageIndex++;
    }

    document.getElementById('name')?.addEventListener('blur', function () {
        const slugField = document.getElementById('slug');
        if (slugField && !slugField.value) {
            slugField.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        }
    });
</script>
