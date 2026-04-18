<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        $titlePrefix = fake()->randomElement([
            'Kejuaraan Informatika',
            'Seri Tech Talk',
            'Kemah Kepemimpinan Kartala',
            'Bootcamp Pengembangan Web',
            'Hari Bakti Masyarakat',
            'Hackathon Internal',
            'Lokakarya UI/UX',
            'Seminar Karier Informatika',
        ]);

        $title = $titlePrefix . ' ' . fake()->numberBetween(2024, 2027);
        $startDate = fake()->dateTimeBetween('-4 months', '+5 months');
        $endDate = fake()->boolean(85)
            ? (clone $startDate)->modify('+' . fake()->numberBetween(2, 8) . ' hours')
            : null;

        $status = 'upcoming';
        if ($startDate < now()) {
            $status = ($endDate !== null && $endDate > now()) ? 'ongoing' : 'past';
        }

        return [
            'title' => $title,
            'slug' => Str::slug($title . '-' . fake()->unique()->numberBetween(10, 9999)),
            'description' => fake('id_ID')->sentence(18),
            'body' => fake('id_ID')->paragraphs(4, true),
            'thumbnail' => $this->randomUnsplashImage('event,seminar,students,campus,technology'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => fake('id_ID')->randomElement([
                'Gedung Mandala, Kampus IV UNPAS',
                'Aula Teknik UNPAS',
                'Laboratorium Informatika UNPAS',
                'Ruang Sidang Fakultas Teknik',
            ]),
            'registration_url' => fake()->boolean(80) ? 'https://forms.gle/' . Str::lower(Str::random(12)) : null,
            'status' => $status,
        ];
    }

    private function randomUnsplashImage(string $keywords): string
    {
        return sprintf(
            'https://source.unsplash.com/1600x900/?%s&sig=%d',
            urlencode($keywords),
            fake()->numberBetween(1, 10000)
        );
    }
}
