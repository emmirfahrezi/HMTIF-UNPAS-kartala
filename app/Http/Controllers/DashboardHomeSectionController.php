<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use Illuminate\Http\Request;

class DashboardHomeSectionController extends Controller
{
    private array $sections = ['hero', 'identity', 'era', 'vision_mission', 'stats'];

    public function index()
    {
        $sections = [];
        foreach ($this->sections as $section) {
            $sections[$section] = HomeSection::where('section', $section)
                ->orderBy('order')
                ->get();
        }

        return view('dashboard.home-sections.index', compact('sections'));
    }

    public function edit(string $section)
    {
        abort_if(!in_array($section, $this->sections), 404);

        $fields = HomeSection::where('section', $section)
            ->orderBy('order')
            ->get()
            ->keyBy('key');

        return view('dashboard.home-sections.edit', compact('section', 'fields'));
    }

    public function update(Request $request, string $section)
    {
        abort_if(!in_array($section, $this->sections), 404);

        // Field gambar per section — jangan timpa dengan nilai kosong
        // agar gambar lama tidak terhapus ketika user tidak mengganti gambar
        $mediaFields = [
            'hero'     => ['background_image'],
            'identity' => ['image'],
            'era'      => ['image'],
        ];

        $sectionMediaFields = $mediaFields[$section] ?? [];
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            if (\in_array($key, $sectionMediaFields, true) && empty($value)) {
                continue;
            }

            HomeSection::set($section, $key, $value);
        }

        return redirect()->route('dashboard.home-sections.index')
            ->with('success', 'Konten halaman berhasil diperbarui.');
    }
}