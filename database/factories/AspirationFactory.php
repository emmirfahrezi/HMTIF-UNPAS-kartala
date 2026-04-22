<?php

namespace Database\Factories;

use App\Models\Aspiration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Aspiration>
 */
class AspirationFactory extends Factory
{
    protected $model = Aspiration::class;

    public function definition(): array
    {
        $statuses = ['pending', 'reviewed', 'resolved'];
        $status = fake()->randomElement($statuses);
        $isSpotlight = fake()->boolean(25);

        return [
            'name' => fake()->boolean(85) ? fake('id_ID')->name() : null,
            'email' => fake()->boolean(80) ? fake()->safeEmail() : null,
            'subject' => fake('id_ID')->randomElement([
                'Perbaikan fasilitas laboratorium',
                'Akses lisensi software mahasiswa',
                'Penambahan jadwal mentoring',
                'Optimalisasi informasi beasiswa',
                'Peningkatan kegiatan minat bakat',
            ]),
            'message' => fake('id_ID')->paragraphs(2, true),
            'tracking_code' => Str::upper(Str::random(16)),
            'status' => $status,
            'is_spotlight' => $isSpotlight,
            'spotlighted_week' => $isSpotlight ? now()->startOfWeek()->toDateString() : null,
        ];
    }
}
