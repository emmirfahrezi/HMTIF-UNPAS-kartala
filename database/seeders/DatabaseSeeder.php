<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::updateOrCreate(
            ['email' => 'admin@hmtif.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('admin1234'),
            ]
        );

        $this->call([
            DivisionSeeder::class,
            StaffSeeder::class,
            ActivitySeeder::class,
            AnnouncementCategorySeeder::class,
            AnnouncementSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            AspirationSeeder::class,
            StatSeeder::class,
        ]);
    }
}
