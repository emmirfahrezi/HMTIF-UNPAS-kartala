<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /** Superadmin selalu lolos, kecuali eksplisit ditolak oleh method lain (mis. delete diri sendiri). */
    public function before(User $authUser, string $ability): ?bool
    {
        if ($ability !== 'delete' && $authUser->isAdmin()) {
            return true;
        }

        return null;
    }

    /** Non-admin tidak boleh mengelola akun admin lain. */
    public function update(User $authUser, User $target): bool
    {
        return ! $target->isAdmin();
    }

    /**
     * Tidak boleh menghapus akun sendiri lewat dashboard (mencegah self-lockout),
     * dan non-admin tidak boleh menghapus akun admin.
     */
    public function delete(User $authUser, User $target): bool
    {
        if ($authUser->id === $target->id) {
            return false;
        }

        return $authUser->isAdmin() || ! $target->isAdmin();
    }
}
