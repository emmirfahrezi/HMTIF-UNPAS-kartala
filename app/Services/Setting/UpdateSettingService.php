<?php

namespace App\Services\Setting;

use App\Models\Setting;

class UpdateSettingService
{
    public function execute(Setting $setting, array $validated): Setting
    {
        $setting->update($validated);

        return $setting;
    }
}
