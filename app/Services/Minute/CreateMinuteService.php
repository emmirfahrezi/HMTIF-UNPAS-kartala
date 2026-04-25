<?php

namespace App\Services\Minute;

use App\Models\Minute;
use Illuminate\Http\UploadedFile;

class CreateMinuteService
{
    public function execute(array $validated, ?UploadedFile $file = null): Minute
    {
        if ($file) {
            $validated['dokumentasi_file'] = $file->store('minutes/files', 'public');
        }

        $minute = Minute::create($validated);

        if (! empty($validated['attendees'])) {
            $this->syncMinuteAttendees($minute, $validated['attendees']);
        }

        return $minute;
    }

    private function syncMinuteAttendees(Minute $minute, array $attendees): void
    {
        $submittedAttendeeIds = [];

        foreach ($attendees as $attendeeData) {
            if (empty($attendeeData['name'])) {
                continue;
            }

            $attendeeData['order'] = isset($attendeeData['order']) ? (int) $attendeeData['order'] : 0;
            $attendeeData['keterangan'] = $attendeeData['keterangan'] ?? 'hadir';

            $created = $minute->attendees()->create([
                'name' => $attendeeData['name'],
                'nim' => $attendeeData['nim'] ?? null,
                'jabatan' => $attendeeData['jabatan'] ?? null,
                'keterangan' => $attendeeData['keterangan'],
                'order' => $attendeeData['order'],
            ]);

            $submittedAttendeeIds[] = $created->id;
        }
    }
}
