<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Aspiration;
use App\Models\Division;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Staff;
use App\Models\Stat;
use App\Models\User;
use Database\Factories\ActivityFactory;
use Database\Factories\AnnouncementCategoryFactory;
use Database\Factories\AnnouncementFactory;
use Database\Factories\AspirationFactory;
use Database\Factories\ProductCategoryFactory;
use Database\Factories\ProductFactory;
use Database\Factories\ProductImageFactory;
use Database\Factories\StaffFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AnnouncementCategory::query()->delete();
        Announcement::query()->delete();
        ProductImage::query()->delete();
        Product::query()->delete();
        ProductCategory::query()->delete();
        Staff::query()->delete();
        Division::query()->delete();
        Activity::query()->delete();
        Aspiration::query()->delete();
        Stat::query()->delete();

        User::updateOrCreate(
            ['email' => 'admin@hmtif.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('admin1234'),
            ]
        );

        collect([
            [
                'name' => 'Badan Pengurus Harian',
                'slug' => 'badan-pengurus-harian',
                'description' => 'Divisi inti pimpinan utama dan badan pengurus harian.',
                'order' => 0,
            ],
            [
                'name' => 'Kajian Strategis dan Advokasi',
                'slug' => 'kajian-strategis-dan-advokasi',
                'description' => 'Divisi yang fokus pada kajian internal dan advokasi organisasi.',
                'order' => 1,
            ],
            [
                'name' => 'Komunikasi dan Informasi',
                'slug' => 'komunikasi-dan-informasi',
                'description' => 'Divisi yang mengelola komunikasi, media, dan informasi organisasi.',
                'order' => 2,
            ],
            [
                'name' => 'Kewirausahaan Kreatif',
                'slug' => 'kewirausahaan-kreatif',
                'description' => 'Divisi yang mengembangkan ide kreatif dan kewirausahaan mahasiswa.',
                'order' => 3,
            ],
            [
                'name' => 'Pengembangan Sumber Daya Mahasiswa',
                'slug' => 'pengembangan-sumber-daya-mahasiswa',
                'description' => 'Divisi yang berfokus pada pengembangan kapasitas mahasiswa.',
                'order' => 4,
            ],
            [
                'name' => 'Minat dan Bakat',
                'slug' => 'minat-dan-bakat',
                'description' => 'Divisi yang mengelola pengembangan minat dan bakat mahasiswa.',
                'order' => 5,
            ],
        ])->each(fn(array $division) => Division::query()->create($division));

        $seedStaff = function (string $position, string $divisionName, int $order, bool $isBph = false): void {
            StaffFactory::new()
                ->forPosition($position, $divisionName, $isBph, $order)
                ->create();
        };

        foreach (
            [
                'Ketua Umum',
                'Sekretaris Jenderal',
                'Sekretaris Umum',
                'Wakil Sekretaris Umum',
                'Bendahara Umum',
                'Wakil Bendahara Umum',
                'Kepala Bidang 1',
                'Kepala Bidang 2',
            ] as $index => $position
        ) {
            $seedStaff($position, 'Badan Pengurus Harian', $index + 1, true);
        }

        foreach (
            [
                'Kajian Strategis dan Advokasi' => ['Koordinator Kastrad', 'Anggota Kastrad'],
                'Komunikasi dan Informasi' => ['Koordinator Kominfo', 'Anggota Kominfo'],
                'Kewirausahaan Kreatif' => ['Koordinator Keskraf', 'Anggota Keskraf'],
                'Pengembangan Sumber Daya Mahasiswa' => ['Koordinator PSDM', 'Anggota PSDM'],
                'Minat dan Bakat' => ['Koordinator PMB', 'Anggota PMB'],
            ] as $divisionName => [$coordinatorPosition, $memberPrefix]
        ) {
            $positions = [$coordinatorPosition, ...collect(range(1, 13))->map(fn(int $number) => $memberPrefix . ' ' . $number)->all()];

            foreach ($positions as $index => $position) {
                $seedStaff($position, $divisionName, $index + 1);
            }
        }

        ActivityFactory::new()->count(18)->create();

        AnnouncementCategoryFactory::new()->count(5)->create();
        AnnouncementFactory::new()->count(30)->create();

        ProductCategoryFactory::new()->count(5)->create();
        $products = ProductFactory::new()->count(20)->create();

        foreach ($products as $product) {
            $primaryImage = ProductImageFactory::new()->state([
                'product_id' => $product->id,
                'is_primary' => true,
                'order' => 1,
            ])->create();

            ProductImageFactory::new()
                ->count(fake()->numberBetween(2, 4))
                ->state([
                    'product_id' => $product->id,
                    'is_primary' => false,
                ])
                ->create();

            $primaryImage->update(['order' => 0]);
        }

        AspirationFactory::new()->count(18)->create();

        collect([
            ['label' => 'Pengurus Aktif', 'value' => '78+', 'icon' => 'users', 'order' => 1],
            ['label' => 'Agenda Proker', 'value' => '14+', 'icon' => 'calendar', 'order' => 2],
            ['label' => 'Departemen', 'value' => '5', 'icon' => 'puzzle', 'order' => 3],
            ['label' => 'Anggota Himpunan', 'value' => '350+', 'icon' => 'academic', 'order' => 4],
        ])->each(fn(array $stat) => Stat::query()->create($stat));
    }
}
