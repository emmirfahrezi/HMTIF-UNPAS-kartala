<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Archive;
use App\Models\Division;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardArchiveController extends Controller
{
    // -----------------------------------------------------------------------
    // Dashboard — CRUD
    // -----------------------------------------------------------------------

    public function index(Request $request): View
    {
        $archives = Archive::with('division')
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))
            ->when($request->filled('division'), fn ($q) => $q->where('division_id', $request->division))
            ->when($request->sort === 'oldest', fn ($q) => $q->oldest('created_at'))
            ->when($request->sort === 'az', fn ($q) => $q->orderBy('name'))
            ->when($request->sort === 'za', fn ($q) => $q->orderByDesc('name'))
            ->when(! \in_array($request->sort, ['oldest', 'az', 'za'], true), fn ($q) => $q->latest('created_at'))
            ->paginate(15)
            ->withQueryString();

        $divisions = Division::orderBy('order')->get(['id', 'name']);
        $types     = Archive::TYPES;

        return view('dashboard.archives.index', compact('archives', 'divisions', 'types'));
    }

    public function create(): View
    {
        $divisions = Division::orderBy('order')->get(['id', 'name']);
        $types     = Archive::TYPES;

        return view('dashboard.archives.create', compact('divisions', 'types'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'type'             => 'required|string|in:' . \implode(',', \array_keys(Archive::TYPES)),
            'division_id'      => 'nullable|exists:divisions,id',
            'file'             => 'required|file|mimes:pdf|max:10240',
            'share_enabled'    => 'boolean',
            'share_expires_at' => 'nullable|date|after:now',
        ]);

        $file = $request->file('file');

        $archive = Archive::create([
            'name'             => $validated['name'],
            'type'             => $validated['type'],
            'division_id'      => $validated['division_id'] ?? null,
            'file_path'        => $file->store('archives', 'public'),
            'file_name'        => $file->getClientOriginalName(),
            'mime_type'        => $file->getMimeType() ?? 'application/pdf',
            'file_size'        => $file->getSize(),
            'share_enabled'    => $request->boolean('share_enabled'),
            'share_expires_at' => $validated['share_expires_at'] ?? null,
        ]);

        ActivityLog::record('created', $archive, "Menambahkan arsip: {$archive->name}");

        return redirect()->route('dashboard.archives')->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function show(Archive $archive): View
    {
        $archive->load('division');

        return view('dashboard.archives.show', compact('archive'));
    }

    public function edit(Archive $archive): View
    {
        $divisions = Division::orderBy('order')->get(['id', 'name']);
        $types     = Archive::TYPES;

        return view('dashboard.archives.edit', compact('archive', 'divisions', 'types'));
    }

    public function update(Request $request, Archive $archive): RedirectResponse
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'type'             => 'required|string|in:' . \implode(',', \array_keys(Archive::TYPES)),
            'division_id'      => 'nullable|exists:divisions,id',
            'file'             => 'nullable|file|mimes:pdf|max:10240',
            'share_enabled'    => 'boolean',
            'share_expires_at' => 'nullable|date',
        ]);

        $data = [
            'name'             => $validated['name'],
            'type'             => $validated['type'],
            'division_id'      => $validated['division_id'] ?? null,
            'share_enabled'    => $request->boolean('share_enabled'),
            'share_expires_at' => $validated['share_expires_at'] ?? null,
        ];

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($archive->file_path);

            $file = $request->file('file');
            $data['file_path'] = $file->store('archives', 'public');
            $data['file_name'] = $file->getClientOriginalName();
            $data['mime_type'] = $file->getMimeType() ?? 'application/pdf';
            $data['file_size'] = $file->getSize();
        }

        $archive->update($data);

        ActivityLog::record('updated', $archive, "Memperbarui arsip: {$archive->name}");

        return redirect()->route('dashboard.archives')->with('success', 'Arsip berhasil diperbarui.');
    }

    public function destroy(Archive $archive): RedirectResponse
    {
        $name = $archive->name;
        ActivityLog::record('deleted', $archive, "Menghapus arsip: {$name}");

        Storage::disk('public')->delete($archive->file_path);
        $archive->delete();

        return redirect()->route('dashboard.archives')->with('success', 'Arsip berhasil dihapus.');
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];

        $archives = Archive::whereIn('id', $ids)->get();
        foreach ($archives as $archive) {
            ActivityLog::record('deleted', $archive, "Menghapus arsip: {$archive->name}");
            Storage::disk('public')->delete($archive->file_path);
            $archive->delete();
        }

        return redirect()->back()->with('success', \count($ids) . ' arsip berhasil dihapus.');
    }

    // -----------------------------------------------------------------------
    // Dashboard — Preview PDF (inline, no download)
    // -----------------------------------------------------------------------

    public function preview(Archive $archive): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $path = Storage::disk('public')->path($archive->file_path);

        abort_unless(file_exists($path), 404);

        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $archive->file_name . '"',
        ]);
    }

    // -----------------------------------------------------------------------
    // Public — Share & Download
    // -----------------------------------------------------------------------

    public function shareView(string $token): View|RedirectResponse
    {
        $archive = Archive::where('share_token', $token)->firstOrFail();

        abort_unless($archive->isShareActive(), 404);

        return view('pages.archive-share', compact('archive'));
    }

    public function download(string $token): Response|RedirectResponse
    {
        $archive = Archive::where('share_token', $token)->firstOrFail();

        abort_unless($archive->isShareActive(), 404);

        return Storage::disk('public')->download($archive->file_path, $archive->file_name);
    }

    public function qrDownload(string $token): RedirectResponse
    {
        $archive = Archive::where('share_token', $token)->firstOrFail();

        abort_unless($archive->isShareActive(), 404);

        return redirect($archive->qr_download_url);
    }

    public function shortRedirect(string $shortCode): RedirectResponse
    {
        $archive = Archive::where('short_code', $shortCode)->firstOrFail();

        abort_unless($archive->isShareActive(), 404);

        return redirect()->route('archives.share', $archive->share_token);
    }

    // -----------------------------------------------------------------------
    // Legacy redirects (id-based → token-based 301)
    // -----------------------------------------------------------------------

    public function legacyShare(Archive $archive): RedirectResponse
    {
        abort_unless($archive->isShareActive(), 404);

        return redirect()->route('archives.share', $archive->share_token, 301);
    }

    public function legacyDownload(Archive $archive): RedirectResponse
    {
        abort_unless($archive->isShareActive(), 404);

        return redirect()->route('archives.download', $archive->share_token, 301);
    }
}
