<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Minute;
use App\Services\Minute\CreateMinuteService;
use App\Services\Minute\DeleteMinuteService;
use App\Services\Minute\GetMinutesDashboardService;
use App\Services\Minute\UpdateMinuteService;
use Illuminate\Http\Request;

class DashboardMinuteController extends Controller
{
    public function __construct(
        private GetMinutesDashboardService $getMinutes,
        private CreateMinuteService $createMinute,
        private UpdateMinuteService $updateMinute,
        private DeleteMinuteService $deleteMinute,
    ) {}

    public function index(Request $request)
    {
        $minutes = $this->getMinutes->execute($request);
        return view('dashboard.minutes.index', compact('minutes'));
    }

    public function create()
    {
        return view('dashboard.minutes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor'              => 'required|string|max:255|unique:minutes,nomor',
            'perihal'            => 'required|string|max:255',
            'tanggal'            => 'required|date',
            'waktu_mulai'        => 'nullable|date_format:H:i',
            'waktu_selesai'      => 'nullable|date_format:H:i',
            'tempat'             => 'nullable|string|max:255',
            'dipimpin_oleh'      => 'nullable|string|max:255',
            'agenda'             => 'nullable|string',
            'isi_rapat'          => 'nullable|string',
            'dokumentasi_file'   => 'nullable|file|max:10240',
            'attendees'          => 'nullable|array',
            'attendees.*.name'   => 'nullable|string|max:255',
            'attendees.*.nim'    => 'nullable|string|max:255',
            'attendees.*.jabatan'     => 'nullable|string|max:255',
            'attendees.*.keterangan'  => 'nullable|string|in:hadir,izin,alpha',
            'attendees.*.order'       => 'nullable|integer',
        ]);

        $minute = $this->createMinute->execute($validated, $request->file('dokumentasi_file'));

        ActivityLog::record('created', $minute, "Menambahkan notulensi: {$minute->perihal}");

        return redirect()->route('dashboard.minutes')->with('success', 'Notulensi berhasil ditambahkan.');
    }

    public function edit(Minute $minute)
    {
        $minute->load('attendees');
        return view('dashboard.minutes.edit', compact('minute'));
    }

    public function update(Request $request, Minute $minute)
    {
        $validated = $request->validate([
            'nomor'              => "required|string|max:255|unique:minutes,nomor,{$minute->id}",
            'perihal'            => 'required|string|max:255',
            'tanggal'            => 'required|date',
            'waktu_mulai'        => 'nullable|date_format:H:i',
            'waktu_selesai'      => 'nullable|date_format:H:i',
            'tempat'             => 'nullable|string|max:255',
            'dipimpin_oleh'      => 'nullable|string|max:255',
            'agenda'             => 'nullable|string',
            'isi_rapat'          => 'nullable|string',
            'dokumentasi_file'   => 'nullable|file|max:10240',
            'attendees'          => 'nullable|array',
            'attendees.*.id'          => 'nullable|integer',
            'attendees.*.name'        => 'nullable|string|max:255',
            'attendees.*.nim'         => 'nullable|string|max:255',
            'attendees.*.jabatan'     => 'nullable|string|max:255',
            'attendees.*.keterangan'  => 'nullable|string|in:hadir,izin,alpha',
            'attendees.*.order'       => 'nullable|integer',
        ]);

        $this->updateMinute->execute($minute, $validated, $request->file('dokumentasi_file'));

        ActivityLog::record('updated', $minute, "Memperbarui notulensi: {$minute->perihal}");

        return redirect()->route('dashboard.minutes')->with('success', 'Notulensi berhasil diperbarui.');
    }

    public function destroy(Minute $minute)
    {
        $perihal = $minute->perihal;
        ActivityLog::record('deleted', $minute, "Menghapus notulensi: {$perihal}");

        $this->deleteMinute->execute($minute);

        return redirect()->route('dashboard.minutes')->with('success', 'Notulensi berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'string'])['ids'];

        $minutes = Minute::whereIn('id', $ids)->get();
        foreach ($minutes as $minute) {
            ActivityLog::record('deleted', $minute, "Menghapus notulensi: {$minute->perihal}");
            $this->deleteMinute->execute($minute);
        }

        return redirect()->back()->with('success', count($ids) . ' notulensi berhasil dihapus.');
    }
}