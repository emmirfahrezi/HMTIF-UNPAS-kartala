<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\Setting\CreateSettingService;
use App\Services\Setting\DeleteSettingService;
use App\Services\Setting\GetSettingsDashboardService;
use App\Services\Setting\UpdateSettingService;
use Illuminate\Http\Request;

class DashboardSettingController extends Controller
{
    public function __construct(
        private GetSettingsDashboardService $getSettings,
        private CreateSettingService $createSetting,
        private UpdateSettingService $updateSetting,
        private DeleteSettingService $deleteSetting,
    ) {}

    public function index(Request $request)
    {
        $settings = $this->getSettings->execute($request);

        return view('dashboard.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('dashboard.settings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'required|string',
            'group' => 'required|string|max:255',
        ]);

        $this->createSetting->execute($validated);

        return redirect()->route('dashboard.settings')->with('success', 'Setting berhasil ditambahkan.');
    }

    public function edit(Setting $setting)
    {
        return view('dashboard.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'key' => "required|string|max:255|unique:settings,key,{$setting->id}",
            'value' => 'required|string',
            'group' => 'required|string|max:255',
        ]);

        $this->updateSetting->execute($setting, $validated);

        return redirect()->route('dashboard.settings')->with('success', 'Setting berhasil diperbarui.');
    }

    public function destroy(Setting $setting)
    {
        $this->deleteSetting->execute($setting);

        return redirect()->route('dashboard.settings')->with('success', 'Setting berhasil dihapus.');
    }
}
