<?php

namespace App\Services\Minute;

use App\Models\Minute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateMinuteService
{
    public function execute(Minute $minute, array $validated, ?UploadedFile $file = null): Minute
    {
        if ($file) {
            if ($minute->dokumentasi_file) {
                Storage::disk('public')->delete($minute->dokumentasi_file);
            }
            $validated['dokumentasi_file'] = $file->store('minutes/files', 'public');
        }

        $minute->update($validated);

        if (isset($validated['attendees'])) {
            $this->syncMinuteAttendees($minute, $validated['attendees']);
        }

        return $minute;
    }

    private function syncMinuteAttendees(Minute $minute, array $attendees): void
    {
        $existingAttendeeIds = $minute->attendees()->pluck('id')->all();
        $submittedAttendeeIds = [];

        foreach ($attendees as $attendeeData) {
            if (empty($attendeeData['name'])) {
                continue;
            }

            $attendeeData['order'] = isset($attendeeData['order']) ? (int) $attendeeData['order'] : 0;
            $attendeeData['keterangan'] = $attendeeData['keterangan'] ?? 'hadir';

            if (! empty($attendeeData['id']) && in_array($attendeeData['id'], $existingAttendeeIds, true)) {
                $submittedAttendeeIds[] = $attendeeData['id'];
                $minute->attendees()->where('id', $attendeeData['id'])->update([
                    'name' => $attendeeData['name'],
                    'nim' => $attendeeData['nim'] ?? null,
                    'jabatan' => $attendeeData['jabatan'] ?? null,
                    'keterangan' => $attendeeData['keterangan'],
                    'order' => $attendeeData['order'],
                ]);
                continue;
            }

            $created = $minute->attendees()->create([
                'name' => $attendeeData['name'],
                'nim' => $attendeeData['nim'] ?? null,
                'jabatan' => $attendeeData['jabatan'] ?? null,
                'keterangan' => $attendeeData['keterangan'],
                'order' => $attendeeData['order'],
            ]);

            $submittedAttendeeIds[] = $created->id;
        }

        if (empty($submittedAttendeeIds)) {
            $minute->attendees()->delete();
            return;
        }

        $minute->attendees()->whereNotIn('id', $submittedAttendeeIds)->delete();
    }
}
