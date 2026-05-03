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

        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            HomeSection::set($section, $key, $value);
        }

        return redirect()->route('dashboard.home-sections.index')
            ->with('success', 'Konten halaman berhasil diperbarui.');
    }
}