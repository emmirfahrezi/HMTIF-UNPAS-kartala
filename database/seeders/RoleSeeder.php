<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $allMenus = array_column(
            array_filter(
                \App\Http\Controllers\DashboardSettingController::MENU_ITEMS,
                fn($item) => $item['type'] !== 'category'
            ),
            'key'
        );

        $staffMenus = [
            'dashboard', 'profile',
            'activities', 'announcements',
            'staffs', 'aspirations', 'minutes',
            'products',
        ];

        $koordinatorMenus = [
            'dashboard', 'profile',
            'home-sections', 'activities', 'announcements', 'announcements/categories',
            'staffs', 'staffs/divisions', 'aspirations', 'minutes',
            'products', 'products/categories',
            'stats',
        ];

        $roles = [
            [
                'name'       => 'Superadmin',
                'can_create' => true,
                'can_read'   => true,
                'can_update' => true,
                'can_delete' => true,
                'menu_access' => $allMenus,
            ],
            [
                'name'       => 'BPH',
                'can_create' => true,
                'can_read'   => true,
                'can_update' => true,
                'can_delete' => true,
                'menu_access' => $allMenus,
            ],
            [
                'name'       => 'Koordinator',
                'can_create' => true,
                'can_read'   => true,
                'can_update' => true,
                'can_delete' => false,
                'menu_access' => $koordinatorMenus,
            ],
            [
                'name'       => 'Staff',
                'can_create' => true,
                'can_read'   => true,
                'can_update' => false,
                'can_delete' => false,
                'menu_access' => $staffMenus,
            ],
        ];

        foreach ($roles as $data) {
            Role::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
