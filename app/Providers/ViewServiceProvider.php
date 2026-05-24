<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewInstance;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * Menyuntikkan variabel otorisasi ke seluruh dashboard view sehingga
     * Frontend dapat menampilkan/menyembunyikan tombol dan menu berdasarkan
     * role user yang sedang login.
     *
     * Variabel yang disuntikkan:
     *
     * - $permissions    (array)  ['read', 'create', 'update', 'delete'] → bool
     *   Dibaca oleh setiap halaman index dashboard (activities, products, dst.)
     *   untuk menentukan akses baca, buat, ubah, dan hapus data.
     *
     * - $hasFullAccess  (bool)   true jika user adalah Superadmin.
     *   Digunakan sidebar untuk menampilkan semua menu tanpa filter.
     *
     * - $allowedMenus   (array)  Daftar key menu yang boleh diakses (misal: ['activities', 'staffs']).
     *   Digunakan sidebar untuk menyembunyikan menu yang tidak diizinkan.
     *   Key 'profile' selalu disertakan agar setiap user bisa mengakses profilnya.
     */
    public function boot(): void
    {
        $views = [
            'dashboard.*',
            'components.layouts.dashboard',
            'components.organisms.dashboard.sidebar',
        ];

        View::composer($views, function (ViewInstance $view): void {
            $user = auth()->user();

            // Tidak login — tidak ada yang perlu diinjeksi
            if (! $user) {
                return;
            }

            // Superadmin: akses penuh ke semua fitur & semua menu
            if ($user->isAdmin()) {
                $view->with([
                    'permissions'   => ['read' => true, 'create' => true, 'update' => true, 'delete' => true],
                    'hasFullAccess' => true,
                    'allowedMenus'  => [],
                ]);

                return;
            }

            // Cari konfigurasi role di database
            $role = null;
            try {
                $role = Role::where('name', $user->role)->first();
            } catch (\Throwable) {
                // Tabel roles belum ada (misal: saat migrate awal) — abaikan
            }

            if (! $role) {
                // Role belum dikonfigurasi di Settings → beri akses baca saja
                $view->with([
                    'permissions'   => ['read' => true, 'create' => false, 'update' => false, 'delete' => false],
                    'hasFullAccess' => false,
                    'allowedMenus'  => ['profile'],
                ]);

                return;
            }

            // Pastikan 'profile' selalu ada di allowedMenus agar user bisa akses profil sendiri
            $allowedMenus = $role->menu_access ?? [];
            if (! \in_array('profile', $allowedMenus, true)) {
                $allowedMenus[] = 'profile';
            }

            $view->with([
                'permissions' => [
                    'read'   => $role->can_read,
                    'create' => $role->can_create,
                    'update' => $role->can_update,
                    'delete' => $role->can_delete,
                ],
                'hasFullAccess' => false,
                'allowedMenus'  => $allowedMenus,
            ]);
        });
    }
}
