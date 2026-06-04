<?php

if (!function_exists('media_url')) {
    /**
     * Resolve path gambar/media dari database menjadi URL yang siap dirender browser.
     *
     * Menangani semua format path yang mungkin tersimpan di DB:
     *   - null / ''                      → asset($placeholder)
     *   - 'https://...' / 'http://...'   → dikembalikan apa adanya (external URL)
     *   - '/storage/...' / '/images/...' → asset(tanpa leading slash)
     *   - 'storage/...' / 'images/...'  → asset($path)
     *   - 'activities/thumbnails/x.jpg'  → asset('storage/' . $path)  (path upload relatif)
     *
     * @param  string|null $path         Path dari database (boleh null/kosong).
     * @param  string      $placeholder  Path asset placeholder (contoh: 'images/placeholders/activity.svg').
     */
    function media_url(?string $path, string $placeholder): string
    {
        if ($path === null || $path === '') {
            return asset($placeholder);
        }

        // External URL — gunakan langsung, kecuali URL localhost yang perlu dikonversi
        // agar tidak terjadi mixed-content blocking ketika site diakses via HTTPS
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            $localBases = ['http://localhost', 'http://127.0.0.1', 'https://localhost'];
            $stripped   = null;

            foreach ($localBases as $base) {
                if (str_starts_with($path, $base)) {
                    $stripped = substr($path, \strlen($base));
                    break;
                }
            }

            // Bukan localhost → kembalikan langsung sebagai external URL
            if ($stripped === null) {
                return $path;
            }

            // Strip localhost prefix, lanjutkan ke resolving path di bawah
            $path = $stripped;
        }

        // Path absolut dengan leading slash — strip lalu asset()
        // Contoh: /storage/xxx.jpg → asset('storage/xxx.jpg')
        //         /images/xxx.svg  → asset('images/xxx.svg')
        if (str_starts_with($path, '/')) {
            return asset(ltrim($path, '/'));
        }

        // Sudah punya prefix storage/ atau images/ — asset() langsung
        if (str_starts_with($path, 'storage/') || str_starts_with($path, 'images/')) {
            return asset($path);
        }

        // Path relatif hasil upload (contoh: activities/thumbnails/xxx.jpg)
        return asset('storage/' . $path);
    }
}
