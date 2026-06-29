<?php

namespace App\Services\User;

use App\Models\User;

class UpdateUserService
{
    public function execute(User $user, array $validated): User
    {
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return $user;
    }
}
