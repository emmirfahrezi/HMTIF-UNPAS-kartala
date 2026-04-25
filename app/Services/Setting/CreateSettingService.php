<?php

namespace App\Services\Setting;

use App\Models\Setting;

class CreateSettingService
{
    public function execute(array $validated): Setting
    {
        return Setting::create($validated);
    }
}
