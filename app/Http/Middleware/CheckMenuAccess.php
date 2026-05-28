<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMenuAccess
{
    /**
     * Key menu dua-segmen yang dikenali (path prefix → menu key).
     * Urutan penting: dicek sebelum satu-segmen agar yang lebih spesifik menang.
     */
    private const TWO_SEGMENT_KEYS = [
        'staffs/divisions',
        'products/categories',
        'announcements/categories',
    ];

    /**
     * Path absolut yang dikecualikan dari pengecekan menu access.
     * Middleware tetap dijalankan, tetapi path ini langsung dilewati tanpa cek.
     */
    private const EXCLUDED_PATHS = [
        '/dashboard',
        '/dashboard/editor/upload',
    ];

    /**
     * Periksa apakah user yang sedang login punya akses ke menu yang sesuai
     * dengan halaman yang diminta.
     *
     * Alur:
     *   1. Tidak login                   → serahkan ke middleware auth
     *   2. Admin                         → lewati semua pengecekan
     *   3. Path dikecualikan             → lewati
     *   4. menuKey = 'profile'           → selalu diizinkan
     *   5. Role tidak ditemukan di DB    → abort(403)
     *   6. menuKey tidak ada di menu_access → abort(403)
     *   7. Lolos semua                   → lanjutkan request
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Tidak terautentikasi — biarkan middleware 'auth' yang menangani
        if (! $user) {
            return $next($request);
        }

        // Superadmin: lewati semua pengecekan
        if ($user->isAdmin()) {
            return $next($request);
        }

        $path = $request->getPathInfo();

        // Lewati path yang dikecualikan
        if (\in_array($path, self::EXCLUDED_PATHS, true)) {
            return $next($request);
        }

        // Tentukan menu key dari path
        $menuKey = $this->resolveMenuKey($path);

        // Path tidak dikenali sebagai path menu → lewati (misal: redirect, wildcard aneh)
        if ($menuKey === null) {
            return $next($request);
        }

        // 'profile' selalu diizinkan agar setiap user bisa akses profilnya sendiri
        if ($menuKey === 'profile') {
            return $next($request);
        }

        // Cari konfigurasi role di database
        $role = null;
        try {
            $role = Role::whereRaw('LOWER(name) = ?', [strtolower($user->role)])->first();
        } catch (\Throwable) {
            // Tabel roles belum ada (misal: saat migrate fresh)
        }

        // Role belum dikonfigurasi → tolak akses (kecuali profile yang sudah dihandle di atas)
        if (! $role) {
            abort(403, 'Akses ditolak. Role Anda belum dikonfigurasi oleh administrator.');
        }

        $allowedMenus = $role->menu_access ?? [];

        if (! \in_array($menuKey, $allowedMenus, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }

    /**
     * Ekstrak menu key dari path dashboard.
     *
     * Contoh mapping:
     *   /dashboard/activities              → activities
     *   /dashboard/activities/create       → activities
     *   /dashboard/staffs/divisions        → staffs/divisions
     *   /dashboard/staffs/divisions/create → staffs/divisions
     *   /dashboard/staffs/create           → staffs
     *   /dashboard/products/categories     → products/categories
     *   /dashboard/announcements/categories/bulk-delete → announcements/categories
     *
     * @return string|null  Menu key, atau null jika path tidak dikenali.
     */
    private function resolveMenuKey(string $path): ?string
    {
        // Hapus prefix /dashboard/ lalu normalisasi
        $relative = trim(preg_replace('#^/dashboard/?#', '', $path), '/');

        if ($relative === '') {
            return null;
        }

        $segments = explode('/', $relative);

        // Coba dua segmen pertama (lebih spesifik)
        if (isset($segments[1])) {
            $twoSegment = $segments[0] . '/' . $segments[1];
            if (\in_array($twoSegment, self::TWO_SEGMENT_KEYS, true)) {
                return $twoSegment;
            }
        }

        // Gunakan segmen pertama
        return $segments[0] ?: null;
    }
}
