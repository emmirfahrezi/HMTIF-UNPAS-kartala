# Backend Handoff — Ringkasan Perubahan (Tahap 1–10)

Dokumen ini merangkum semua perubahan yang telah dilakukan di sisi Backend sebagai respons atas setiap tahap handoff dari tim Frontend.

---

## Tahap 1–3 — Pembersihan Logika di Frontend, Login/Logout Log, Rate Limit Aspirasi

### Model — Accessor & Konstanta Baru

Semua logika yang sebelumnya ditulis sebagai `@php` di Blade kini dipindahkan ke model sebagai **accessor** (callable via `$model->property`).

#### `User`
| Accessor / Konstanta | Penggunaan |
|---|---|
| `ROLES` | Opsi dropdown form (value → label singkat) |
| `ROLE_LABELS` | Label tampilan UI (`'admin'` → `'Superadmin'`) |
| `$user->name` | Nama dari `staff->name`, fallback ke email |
| `$user->role_label` | Label role yang ramah pengguna |
| `$user->initial` | Inisial satu huruf untuk avatar |
| `$user->avatar_url` | URL foto profil / DiceBear fallback *(Tahap 8)* |

#### `Activity`
| Accessor / Konstanta | Penggunaan |
|---|---|
| `STATUSES` | `['upcoming' => 'Mendatang', ...]` |
| `$activity->status_label` | Label status Bahasa Indonesia |
| `$activity->thumbnail_url` | URL thumbnail / placeholder SVG |

#### `Announcement`
| Accessor / Konstanta | Penggunaan |
|---|---|
| `$announcement->thumbnail_url` | URL thumbnail / placeholder SVG |
| `$announcement->category_name` | Nama kategori atau `'Umum'` jika null |

#### `Aspiration`
| Accessor / Konstanta | Penggunaan |
|---|---|
| `STATUSES` | Termasuk `step` & `label` per status |
| `$aspiration->status_label` | Label status |
| `$aspiration->status_step` | Nomor langkah (untuk progress indicator) |
| `$aspiration->status_badge_class` | Kelas Tailwind CSS untuk badge |
| `$aspiration->status_dot_color` | Warna dot status |
| `$aspiration->default_feedback_message` | Pesan default admin per status |

#### `Product`
| Accessor / Konstanta | Penggunaan |
|---|---|
| `CLOTHING_SIZES` | `['S','M','L','XL','XXL']` |
| `CLOTHING_CATEGORY_SLUGS` | `['pakaian']` — kategori yang perlu pilihan ukuran |
| `$product->primary_image_url` | URL gambar utama / placeholder SVG |
| `$product->formatted_phone` | Nomor telepon format internasional (`62xxx`) |
| `$product->show_sizes` | Boolean — apakah perlu pilihan ukuran |
| `$product->available_sizes` | Array ukuran (kosong jika bukan pakaian) |

#### `Division`
| Accessor / Konstanta | Penggunaan |
|---|---|
| `ABBREVIATIONS` | Singkatan nama divisi |
| `$division->isBph()` | Method — apakah divisi ini BPH |
| `$division->roles_to_show` | Role yang ditampilkan di halaman detail divisi |
| `$division->abbreviation_code` | Singkatan divisi |

#### `Staff`
| Accessor / Konstanta | Penggunaan |
|---|---|
| `LEADER_POSITIONS` | `['Ketua Himpunan', 'Ketua Umum']` |
| `DEPT_ABBREVIATIONS` | Singkatan jabatan BPH |
| `$staff->isLeader()` | Method — apakah jabatan ketua |
| `$staff->abbreviation` | Singkatan jabatan |

#### `HomeSection`
| Method Statis | Penggunaan |
|---|---|
| `HomeSection::parseMissions($text)` | Parse teks misi HTML/plain menjadi array |
| `HomeSection::defaultMissions()` | Array misi default jika DB kosong |

---

### Tambahan Lain Tahap 1–3

- **`GetDivisionsService`** — parameter `excludeBph: true` untuk halaman `/staff`
- **`GetHomeSectionsService`** *(baru)* — mengirim `$homeSections` ke `home.blade.php` sebagai nested array, kompatibel dengan `data_get($homeSections, 'hero.tagline', 'fallback')`; parsing misi sudah dilakukan di service
- **Activity Log Login/Logout** — `AppServiceProvider` mendengarkan event `Login` dan `Logout` Laravel, mencatat ke tabel `activity_logs`
- **Rate Limiting Aspirasi** — `POST /aspirations` dibatasi 5 pengiriman per 10 menit per IP; jika terlampaui, redirect back dengan pesan error Bahasa Indonesia

---

## Tahap 4 — Upload Thumbnail / Foto

Semua form yang memiliki dual-source (URL / File Lokal) kini didukung di backend.

### Cara Kerja
- Jika `thumbnail_file` (atau `photo_file`) dikirim, file disimpan ke storage dan **menimpa** nilai URL di field `thumbnail`/`photo`
- File lama otomatis dihapus saat **update** (kecuali URL eksternal)

### Input Name yang Diperlukan di Form

| Form | Input File | Disimpan ke |
|---|---|---|
| Pengumuman | `name="thumbnail_file"` | `storage/announcements/thumbnails/` |
| Kegiatan | `name="thumbnail_file"` | `storage/activities/thumbnails/` |
| Pengurus | `name="photo_file"` | `storage/staffs/photos/` |
| Produk (per gambar) | `name="images[i][image_file]"` | `storage/products/images/` |

> **Penting:** Semua form upload wajib memiliki `enctype="multipart/form-data"`

---

## Tahap 5 — API Upload Gambar Editor (Quill.js)

### Endpoint
```
POST /dashboard/editor/upload
```

| | |
|---|---|
| **Payload** | `multipart/form-data`, key: `image` |
| **CSRF** | Otomatis via session cookie / `X-CSRF-TOKEN` header |
| **Auth** | Wajib login |
| **Rate limit** | 30 request per menit per user |
| **Named route** | `dashboard.editor.upload` |

### Response

**Sukses `200`:**
```json
{ "url": "https://domain.test/storage/editor/images/namafile.jpg" }
```

**Gagal validasi `422`:**
```json
{ "message": "...", "errors": { "image": ["..."] } }
```

File disimpan di: `storage/app/public/editor/images/`

---

## Tahap 6 — Hapus Semua Pengurus (Truncate)

```
DELETE /dashboard/staffs/truncate
```

Named route: `dashboard.staffs.truncate`

- Membersihkan file foto lokal (bukan URL eksternal) sebelum menghapus record
- `users.staff_id` otomatis menjadi `null` (skema DB sudah `nullOnDelete`)
- Mencatat di activity log

---

## Tahap 7 — (tidak ada perubahan Backend)

---

## Tahap 8 — Halaman Profil

### Variabel yang dikirim ke `dashboard.profile.index`

```php
$user->name        // dari staff->name atau email
$user->email
$user->role_label  // 'Superadmin' | 'BPH' | 'Koordinator' | 'Staff'
$user->initial     // huruf pertama nama
$user->avatar_url  // URL foto / DiceBear SVG fallback

$staff?->bio
$staff?->instagram
$staff?->linkedin
$staff?->github    // ← KOLOM BARU (jalankan: php artisan migrate)
```

### Migration Baru
```bash
php artisan migrate
# Menambahkan kolom `github` (nullable) ke tabel `staffs`
```

### Controller Profil
Tiga closure di `web.php` sudah dipindahkan ke `DashboardProfileController`:
- `GET  /dashboard/profile`          → `index()`
- `PUT  /dashboard/profile`          → `update()` *(+ field github)*
- `PUT  /dashboard/profile/password` → `updatePassword()`

---

## Tahap 9 — Filter & Sort Halaman Client

### Query Parameter yang Didukung

| Halaman | Parameter | Nilai yang Valid |
|---|---|---|
| `/activities` | `status`, `search`, `sort` | `latest`\|`oldest`\|`az`\|`za` |
| `/announcements` | `category_id`, `search`, `sort` | `latest`\|`oldest`\|`az`\|`za` |
| `/store` | `category`, `search`, `sort` | `latest`\|`oldest`\|`az`\|`za`\|`price_asc`\|`price_desc` |

Semua halaman menggunakan `.withQueryString()` — pagination link otomatis menyertakan filter aktif.

---

## Tahap 10 — Route Cleanup & Refactoring (Route Caching)

Seluruh closure di `routes/web.php` telah dipindahkan ke controller. Perintah `php artisan route:cache` kini bisa dijalankan.

### Controller Baru

| Controller | Route yang Ditangani |
|---|---|
| `PageController` | Semua 11 halaman publik + `/dev/components` |
| `Auth\SetupPasswordController` | `GET/POST /setup-password`, `GET /setup-password-success` |

### Controller yang Diperbarui

| Controller | Method Baru |
|---|---|
| `Auth\LoginController` | `showLoginForm()`, `logoutWeb()` *(+ fix bug `logoutService->execute` → `logout`)* |
| `DashboardAspirationController` | `show()`, `feedback()` |
| `DashboardMinuteController` | `show()`, `print()` |

---

## Catatan Tambahan

### `php artisan route:cache`
Setelah Tahap 10, jalankan untuk performa routing yang lebih cepat:
```bash
php artisan route:cache
```
Jika ada perubahan route, jalankan `php artisan route:clear` terlebih dahulu.

### Naming Convention Route yang Berubah
Semua nama route **tidak berubah** — refactoring ini hanya memindahkan implementasi dari closure ke controller, tidak mengubah URL atau nama route.

### File yang Perlu `php artisan migrate`
- **Tahap 8** — `add_github_to_staffs_table`
