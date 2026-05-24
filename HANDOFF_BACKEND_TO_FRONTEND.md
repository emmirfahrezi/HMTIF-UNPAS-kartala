# Catatan Backend untuk Frontend — Tahap 1–10

Halo tim Frontend! Berikut adalah ringkasan semua perubahan yang sudah selesai di sisi Backend sebagai respons atas seluruh handoff (Tahap 1–10). Dokumen ini berisi apa saja yang perlu kalian **lakukan**, **sesuaikan**, dan **manfaatkan** di sisi Frontend.

---

## 🔴 Wajib Dilakukan (Fitur Belum Berfungsi Tanpa Ini)

### 1. Form Produk — Tambahkan `name` pada Input File Gambar

Di `products/_form.blade.php`, input `<input type="file">` untuk gambar produk belum memiliki atribut `name`. Tambahkan sesuai indeks loop:

```html
<input type="file" name="images[{{ $i }}][image_file]" accept="image/*">
```

Tanpa ini, upload gambar produk dari file lokal tidak akan terkirim ke Backend.

---

### 2. Editor Quill.js — Ganti URL Upload Gambar

Endpoint yang benar untuk upload gambar dari editor **bukan** `/api/editor/upload`, melainkan:

```
POST /dashboard/editor/upload
```

Sesuaikan konfigurasi handler Quill.js di **semua** form yang memiliki rich-text editor (Pengumuman, Kegiatan, Notulensi, dll.).

**Detail endpoint:**
| | |
|---|---|
| Method | `POST` |
| URL | `/dashboard/editor/upload` |
| Payload | `multipart/form-data`, key: `image` |
| CSRF | Kirim header `X-CSRF-TOKEN` (sudah otomatis jika pakai meta tag) |
| Response sukses | `{ "url": "https://..." }` |
| Response gagal | `{ "message": "...", "errors": { "image": [...] } }` |

---

### 3. Form Profil — Tambahkan Input GitHub

Kolom `github` sudah ditambahkan ke database (migrasi sudah dijalankan). Tambahkan input di halaman profil (`dashboard/profile/index.blade.php`):

```html
<input type="text" name="github" value="{{ $staff?->github }}" placeholder="https://github.com/username">
```

---

## 🟡 Perlu Disesuaikan (Cleanup Blade)

### 4. `vision-mission.blade.php` — Sederhanakan Blok Parsing Misi

Logika parsing misi (HTML/plain text) sudah **dipindahkan sepenuhnya ke Backend** (`GetHomeSectionsService`). Hapus seluruh blok `@php` lama yang melakukan parsing, ganti dengan satu baris:

```php
@php
    $missions = data_get($homeSections, 'vision_mission.missions', []);
@endphp
```

Variabel lain seperti `$vmLabel`, `$vmTitle`, `$visionText`, dll. tetap bisa diambil dengan `data_get()` seperti biasa — tidak perlu diubah.

---

### 5. Hapus `@php` Logika Bisnis yang Tersisa di Blade

Semua logika yang sebelumnya ditulis sebagai `@php` di Blade sudah dipindahkan ke Backend sebagai **accessor**. Cukup panggil propertinya langsung.

#### User
```php
{{-- Sebelum --}}
@php $label = match($user->role) { 'admin' => 'Superadmin', ... }; @endphp
@php $initial = strtoupper(substr($user->name ?? $user->email, 0, 1)); @endphp
@php $avatar = $user->staff?->photo ? ... : 'https://api.dicebear.com/...'; @endphp

{{-- Sekarang (gunakan accessor) --}}
{{ $user->role_label }}   {{-- 'Superadmin', 'BPH', 'Koordinator', 'Staff' --}}
{{ $user->initial }}      {{-- huruf pertama nama --}}
{{ $user->avatar_url }}   {{-- URL foto / DiceBear fallback otomatis --}}
{{ $user->name }}         {{-- dari staff->name, fallback ke email --}}
```

#### Kegiatan (Activity)
```php
{{-- Sekarang --}}
{{ $activity->status_label }}   {{-- 'Mendatang', 'Berlangsung', 'Selesai' --}}
{{ $activity->thumbnail_url }}  {{-- URL thumbnail / placeholder SVG otomatis --}}
```

#### Pengumuman (Announcement)
```php
{{-- Sekarang --}}
{{ $announcement->thumbnail_url }}   {{-- URL thumbnail / placeholder SVG otomatis --}}
{{ $announcement->category_name }}   {{-- nama kategori / 'Umum' jika null --}}
```

#### Aspirasi (Aspiration)
```php
{{-- Sekarang --}}
{{ $aspiration->status_label }}         {{-- label status Bahasa Indonesia --}}
{{ $aspiration->status_step }}          {{-- nomor langkah (1, 2, 3, 0=ditolak) --}}
{{ $aspiration->status_badge_class }}   {{-- kelas Tailwind untuk badge --}}
{{ $aspiration->status_dot_color }}     {{-- warna dot --}}
{{ $aspiration->default_feedback_message }} {{-- pesan default admin --}}
```

#### Produk (Product)
```php
{{-- Sekarang --}}
{{ $product->primary_image_url }}  {{-- URL gambar utama / placeholder SVG --}}
{{ $product->formatted_phone }}    {{-- nomor telepon format 62xxx --}}
{{ $product->show_sizes }}         {{-- boolean: perlu pilihan ukuran? --}}
{{ $product->available_sizes }}    {{-- array: ['S','M','L','XL','XXL'] atau [] --}}
```

#### Divisi (Division)
```php
{{-- Sekarang --}}
{{ $division->abbreviation_code }}  {{-- singkatan divisi, misal: 'KASTRAD' --}}
{{ $division->roles_to_show }}      {{-- array role yang ditampilkan di detail divisi --}}
@if($division->isBph()) ... @endif  {{-- apakah divisi BPH --}}
```

#### Staff
```php
{{-- Sekarang --}}
{{ $staff->abbreviation }}  {{-- singkatan jabatan, misal: 'SEKJEN' --}}
@if($staff->isLeader()) ... @endif  {{-- apakah jabatan ketua --}}
```

---

### 6. Form Pengurus, Kegiatan, Pengumuman — Validasi Field `photo`

Di form Pengurus, validasi `photo` di backend sudah diubah dari `nullable|url` menjadi `nullable|string`. Artinya field ini sekarang menerima **URL maupun path lokal**. Tidak ada perubahan yang perlu dilakukan di Frontend — ini hanya info agar tidak bingung saat debugging.

---

## 🟢 Tidak Perlu Diubah (Sudah Berfungsi)

| Fitur | Status |
|---|---|
| Semua nama route (`route('home')`, `route('dashboard.staffs')`, dll.) | ✅ Tidak berubah |
| Filter & sort halaman Activities, Announcements, Store | ✅ Backend sudah menangkap `?search=&sort=&status=` |
| Upload thumbnail Pengumuman (`thumbnail_file`) | ✅ Siap |
| Upload thumbnail Kegiatan (`thumbnail_file`) | ✅ Siap |
| Upload foto Pengurus (`photo_file`) | ✅ Siap |
| Hapus semua pengurus (`DELETE /dashboard/staffs/truncate`) | ✅ Siap |
| Halaman profil — variabel `$user` dan `$staff` | ✅ Sudah dikirim dari controller |
| Login/logout tercatat di Activity Log | ✅ Aktif |
| Rate limiting form aspirasi (5x/10 menit) | ✅ Aktif |

---

## 📋 Checklist Frontend

```
[ ] products/_form.blade.php     → tambah name="images[{{ $i }}][image_file]"
[ ] Konfigurasi Quill.js         → ubah URL ke POST /dashboard/editor/upload
[ ] Form profil                  → tambah input name="github"
[ ] vision-mission.blade.php     → sederhanakan @php parsing misi
[ ] Blade lain                   → ganti @php logika bisnis dengan accessor
```

---

## ℹ️ Info Teknis Tambahan

### Storage & Upload
Semua file yang diupload disimpan di `storage/app/public/` dan dapat diakses via `/storage/`. Pastikan `php artisan storage:link` sudah dijalankan di environment masing-masing.

| Jenis File | Lokasi di Storage |
|---|---|
| Thumbnail pengumuman | `announcements/thumbnails/` |
| Thumbnail kegiatan | `activities/thumbnails/` |
| Foto pengurus | `staffs/photos/` |
| Gambar produk | `products/images/` |
| Gambar dari editor | `editor/images/` |

### Pagination dengan Filter Aktif
Semua halaman publik yang memiliki filter kini menggunakan `.withQueryString()`, artinya link "Halaman 2", "Halaman 3", dst. secara otomatis sudah menyertakan parameter `search`, `sort`, `status`, `category` yang sedang aktif. Tidak perlu penanganan khusus di Frontend.

---

Terima kasih atas kerja sama selama 10 tahap ini! 🚀
