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
use App\Models\DeveloperTeamMember;
use App\Models\DeveloperTeamMilestone;
use App\Models\DeveloperTeamSetting;
use App\Models\Period;
use App\Models\Staff;
use App\Models\StaffPeriod;
use App\Models\User;
use App\Models\HomeSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DeveloperTeamMember::query()->delete();
        DeveloperTeamMilestone::query()->delete();
        DeveloperTeamSetting::query()->delete();
        Announcement::query()->delete();
        AnnouncementCategory::query()->delete();
        ProductImage::query()->delete();
        Product::query()->delete();
        ProductCategory::query()->delete();
        StaffPeriod::query()->delete();
        Staff::query()->delete();
        Division::query()->delete();
        Period::query()->delete();
        Activity::query()->delete();
        Aspiration::query()->delete();
        User::query()->delete();

        Schema::enableForeignKeyConstraints();

        $this->call([
            RoleSeeder::class,
            DivisionSeeder::class,
            PeriodSeeder::class,
            AnnouncementCategorySeeder::class,
            ProductCategorySeeder::class,
            ActivitySeeder::class,
            AnnouncementSeeder::class,
            StaffSeeder::class,
            ProductSeeder::class,
            AspirationSeeder::class,
            HomeSectionSeeder::class,
            DeveloperTeamSeeder::class,
        ]);

        $adminEmail    = env('SEED_ADMIN_EMAIL', '');
        $adminPassword = env('SEED_ADMIN_PASSWORD', '');

        if (empty($adminEmail) || empty($adminPassword)) {
            $this->command->warn('Seeder admin dilewati: SEED_ADMIN_EMAIL atau SEED_ADMIN_PASSWORD belum diset di .env');
            return;
        }

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'password'          => bcrypt($adminPassword),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}