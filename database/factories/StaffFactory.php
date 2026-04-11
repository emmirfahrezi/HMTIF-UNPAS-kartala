<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Staff;
use Database\Factories\DivisionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Staff>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;

    public function definition(): array
    {
        return $this->buildAttributes(fake()->randomElement($this->roleBlueprints()));
    }

    public function forPosition(string $position, ?string $divisionName = null, ?bool $isBph = null, ?int $order = null): static
    {
        return $this->state(fn() => $this->buildAttributes([
            'position' => $position,
            'division' => $divisionName,
            'is_bph' => $isBph,
            'order' => $order,
        ]));
    }

    private function buildAttributes(array $role): array
    {
        $username = Str::of(fake()->userName())->lower()->replace('.', '');
        $divisionId = $this->resolveDivisionId($role['division'] ?? null);

        return [
            'division_id' => $divisionId,
            'name' => fake('id_ID')->name(),
            'position' => $role['position'],
            'photo' => $this->randomUnsplashImage('portrait,student,indonesia,campus'),
            'bio' => fake('id_ID')->paragraph(3),
            'instagram' => 'https://instagram.com/' . $username,
            'linkedin' => 'https://linkedin.com/in/' . $username,
            'order' => $role['order'] ?? fake()->numberBetween(1, 30),
            'is_active' => $role['is_active'] ?? true,
            'is_bph' => $role['is_bph'] ?? $this->defaultIsBph($role['position']),
        ];
    }

    private function resolveDivisionId(?string $divisionName): int
    {
        if ($divisionName) {
            $divisionId = Division::query()->where('name', $divisionName)->value('id');

            if ($divisionId) {
                return $divisionId;
            }
        }

        return Division::query()->inRandomOrder()->value('id') ?? DivisionFactory::new()->create()->id;
    }

    private function defaultIsBph(string $position): bool
    {
        return in_array($position, [
            'Ketua Umum',
            'Sekretaris Jenderal',
            'Sekretaris Umum',
            'Wakil Sekretaris Umum',
            'Bendahara Umum',
            'Wakil Bendahara Umum',
            'Kepala Bidang 1',
            'Kepala Bidang 2',
        ], true);
    }

    private function roleBlueprints(): array
    {
        return [
            ['position' => 'Ketua Umum', 'division' => 'Badan Pengurus Harian', 'is_bph' => true],
            ['position' => 'Sekretaris Jenderal', 'division' => 'Badan Pengurus Harian', 'is_bph' => true],
            ['position' => 'Sekretaris Umum', 'division' => 'Badan Pengurus Harian', 'is_bph' => true],
            ['position' => 'Wakil Sekretaris Umum', 'division' => 'Badan Pengurus Harian', 'is_bph' => true],
            ['position' => 'Bendahara Umum', 'division' => 'Badan Pengurus Harian', 'is_bph' => true],
            ['position' => 'Wakil Bendahara Umum', 'division' => 'Badan Pengurus Harian', 'is_bph' => true],
            ['position' => 'Kepala Bidang 1', 'division' => 'Badan Pengurus Harian', 'is_bph' => true],
            ['position' => 'Kepala Bidang 2', 'division' => 'Badan Pengurus Harian', 'is_bph' => true],
            ['position' => 'Koordinator Kastrad', 'division' => 'Kajian Strategis dan Advokasi'],
            ['position' => 'Anggota Kastrad', 'division' => 'Kajian Strategis dan Advokasi'],
            ['position' => 'Koordinator Kominfo', 'division' => 'Komunikasi dan Informasi'],
            ['position' => 'Anggota Kominfo', 'division' => 'Komunikasi dan Informasi'],
            ['position' => 'Koordinator Keskraf', 'division' => 'Kewirausahaan Kreatif'],
            ['position' => 'Anggota Keskraf', 'division' => 'Kewirausahaan Kreatif'],
            ['position' => 'Koordinator PSDM', 'division' => 'Pengembangan Sumber Daya Mahasiswa'],
            ['position' => 'Anggota PSDM', 'division' => 'Pengembangan Sumber Daya Mahasiswa'],
            ['position' => 'Koordinator PMB', 'division' => 'Minat dan Bakat'],
            ['position' => 'Anggota PMB', 'division' => 'Minat dan Bakat'],
        ];
    }

    private function randomUnsplashImage(string $keywords): string
    {
        return sprintf(
            'https://source.unsplash.com/800x1000/?%s&sig=%d',
            urlencode($keywords),
            fake()->numberBetween(1, 10000)
        );
    }
}
