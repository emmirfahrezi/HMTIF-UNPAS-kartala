<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Activity;
use App\Models\Aspiration;
use App\Models\Division;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Staff;
use App\Models\Stat;
use App\Models\User;
use App\Models\HomeSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Announcement::query()->delete();
        AnnouncementCategory::query()->delete();
        ProductImage::query()->delete();
        Product::query()->delete();
        ProductCategory::query()->delete();
        Staff::query()->delete();
        Division::query()->delete();
        Activity::query()->delete();
        Aspiration::query()->delete();
        Stat::query()->delete();
        User::query()->delete();

        Schema::enableForeignKeyConstraints();

        $this->call([
            DivisionSeeder::class,
            AnnouncementCategorySeeder::class,
            ProductCategorySeeder::class,
            ActivitySeeder::class,
            AnnouncementSeeder::class,
            StaffSeeder::class,
            ProductSeeder::class,
            AspirationSeeder::class,
            StatSeeder::class,
            HomeSectionSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'hmtif2526@gmail.com'],
            [
                'name'     => 'admin',
                'password' => bcrypt('kartala2526'),
                'role'     => 'admin',
                'email_verified_at'  => now(),
            ]
        );
    }
}