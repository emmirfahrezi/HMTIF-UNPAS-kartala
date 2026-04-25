<?php

namespace App\Services\Setting;

use App\Models\Setting;

class DeleteSettingService
{
    public function execute(Setting $setting): void
    {
        $setting->delete();
    }
}
