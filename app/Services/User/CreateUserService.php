<?php

namespace App\Services\User;

use App\Models\User;

class CreateUserService
{
    public function execute(array $validated): User
    {
        return User::create($validated);
    }
}
