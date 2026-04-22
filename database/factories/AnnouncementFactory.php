<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Database\Factories\AnnouncementCategoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Announcement>
 */
class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition(): array
    {
        $topic = fake()->randomElement([
            'Rekrutmen Panitia Terbuka',
            'Pendaftaran Delegasi Mubes',
            'Jadwal Rapat Pleno Kabinet',
            'Informasi Lomba Tingkat Nasional',
            'Lokakarya Karier dan Portofolio',
            'Pengumuman Beasiswa Internal',
            'Sosialisasi Program Kerja',
        ]);

        $title = $topic . ' ' . fake()->numberBetween(2026, 2027);

        return [
            'announcement_category_id' => AnnouncementCategory::query()->inRandomOrder()->value('id')
                ?? AnnouncementCategoryFactory::new()->create()->id,
            'title' => $title,
            'slug' => Str::slug($title . '-' . fake()->unique()->numberBetween(10, 9999)),
            'excerpt' => fake('id_ID')->sentence(22),
            'body' => fake('id_ID')->paragraphs(5, true),
            'thumbnail' => $this->randomUnsplashImage('meeting,announcement,students,university'),
            'published_at' => fake()->dateTimeBetween('-3 months', 'now'),
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
