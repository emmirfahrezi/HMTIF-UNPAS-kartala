# Analisis Warna Project HMTIF-UNPAS (Sisi User)

Berdasarkan analisis pada file-file template Blade, layout, dan konfigurasi Tailwind, berikut adalah rincian palet warna yang digunakan pada bagian user.

## 1. Palet Warna Utama (Tema Hijau)

Project ini sangat didominasi oleh warna hijau yang memberikan kesan profesional, akademis, dan segar (sesuai dengan tema Kabinet "Harmoni").

| Warna | Hex Code | Penggunaan Utama |
| :--- | :--- | :--- |
| **Primary Green** | `#248232` | Heading (`HMTIF`, `Kegiatan`), Link Navigasi, Ikon SVG, Border Tombol, Badge Kategori. |
| **Deep Green** | `#1A472A` | Background section Testimoni, Tombol "Back to Top", Awal Gradient Footer. |
| **Dark Forest** | `#0A2815` | Bottom Bar Footer (Hak Cipta). |
| **Hover Green** | `#165223` / `#1a6025` | State hover pada tombol utama dan tombol "Back to Top". |
| **Soft Green (Accent)** | `#248232/10` | Overlay dekoratif, pola geometris di background, dan state hover yang sangat subtle. |

## 2. Warna Netral & Latar Belakang

Warna netral digunakan untuk menjaga keterbacaan teks dan memberikan ruang antar elemen.

| Warna | Nama/Code | Penggunaan Utama |
| :--- | :--- | :--- |
| **Pure White** | `#FFFFFF` | Latar belakang utama halaman, Navbar, dan Card konten (Kegiatan/Pengumuman). |
| **Section Gray** | `#F6F6F6` | Latar belakang selang-seling antar section untuk pemisah konten yang lembut. |
| **Heading Text** | `#111827` (Gray-900) | Judul besar dan teks yang membutuhkan kontras tinggi. |
| **Body Text** | `#4B5563` (Gray-600) | Teks deskripsi, paragraf, dan informasi sekunder. |
| **Border/Divider** | `#E5E7EB` (Gray-200) | Garis pemisah antar konten, border input form, dan table border. |

## 3. Warna Aksen & Feedback

Warna fungsional yang digunakan untuk menarik perhatian atau memberikan informasi status.

- **Kuning (Beta/Alert)**: 
    - `#FEFCE8` (Yellow-50) untuk background alert.
    - `#FDE68A` (Yellow-200) untuk badge "BETA".
    - `#92400E` (Yellow-800) untuk teks peringatan.
- **Gradient**:
    - `bg-gradient-to-r from-[#1A472A] to-[#2C5338]` digunakan pada footer untuk memberikan kesan premium.

## Kesimpulan Desain Warna
Desain warna pada sisi user sangat konsisten menggunakan **Monochromatic Green Schema** dengan variasi *brightness* yang terukur. 
- **Kontras**: Penggunaan teks Gray-900 di atas latar belakang putih/F6F6F6 sangat baik untuk aksesibilitas.
- **Branding**: Warna `#248232` berfungsi sebagai identitas visual yang kuat di hampir setiap komponen interaktif (link, button, ikon).
- **Nuansa**: Perpaduan Hijau Tua dan Putih memberikan kesan yang "bersih" dan "terpercaya".

> [!TIP]
> Jika ingin menambahkan fitur baru, pastikan tetap menggunakan variabel warna `#248232` sebagai warna aksi utama agar tetap selaras dengan komponen yang sudah ada.
