<?php

use App\Models\Activity;
use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Archive;
use App\Models\Aspiration;
use App\Models\DeveloperTeamMember;
use App\Models\DeveloperTeamMilestone;
use App\Models\DeveloperTeamSetting;
use App\Models\Division;
use App\Models\Minute;
use App\Models\Period;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Role;
use App\Models\Staff;
use App\Models\StaffPeriod;
use App\Models\User;
use App\Services\Mail\MailService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
    Storage::fake('public');

    $this->admin = User::factory()->create([
        'email' => 'admin@example.test',
        'role' => 'admin',
    ]);

    $this->actingAs($this->admin);

    $this->mock(MailService::class, function (MockInterface $mock) {
        $mock->shouldIgnoreMissing();
    });
});

function announcementPayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Pengumuman CRUD Dashboard',
        'slug' => 'pengumuman-crud-dashboard',
        'excerpt' => 'Ringkasan pengumuman dashboard.',
        'body' => 'Isi pengumuman dashboard untuk kebutuhan test CRUD.',
        'published_at' => now()->format('Y-m-d H:i:s'),
    ], $overrides);
}

function activityPayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Kegiatan CRUD Dashboard',
        'slug' => 'kegiatan-crud-dashboard',
        'description' => 'Deskripsi kegiatan dashboard.',
        'body' => 'Isi kegiatan dashboard untuk kebutuhan test CRUD.',
        'start_date' => now()->addDay()->format('Y-m-d H:i:s'),
        'end_date' => now()->addDays(2)->format('Y-m-d H:i:s'),
        'location' => 'Kampus IV UNPAS',
        'registration_url' => 'https://example.test/daftar',
        'status' => 'upcoming',
    ], $overrides);
}

function productPayload(ProductCategory $category, array $overrides = []): array
{
    return array_merge([
        'name' => 'Produk CRUD Dashboard',
        'slug' => 'produk-crud-dashboard',
        'product_category_id' => $category->id,
        'price' => 150000,
        'phone_number' => '081234567890',
        'order_text' => 'Halo, saya ingin pesan produk ini.',
        'is_available' => true,
        'description' => 'Deskripsi produk dashboard.',
        'images' => [
            [
                'image_path' => 'products/images/sample.png',
                'order' => 0,
                'is_primary' => true,
            ],
        ],
    ], $overrides);
}

function divisionPayload(array $overrides = []): array
{
    return array_merge([
        'name' => 'Kominfo Test',
        'slug' => 'kominfo-test',
        'abbreviation' => 'KOM',
        'description' => 'Divisi untuk test dashboard.',
        'order' => 1,
    ], $overrides);
}

function periodPayload(array $overrides = []): array
{
    return array_merge([
        'label' => '2026/2027',
        'display_order' => 1,
        'is_active' => true,
    ], $overrides);
}

function minutePayload(Division $division, array $overrides = []): array
{
    return array_merge([
        'division_id' => $division->id,
        'nomor' => '001/HMTIF/VI/2026',
        'perihal' => 'Rapat Koordinasi Dashboard',
        'tanggal' => now()->format('Y-m-d'),
        'waktu_mulai' => '09:00',
        'waktu_selesai' => '11:00',
        'tempat' => 'Sekretariat HMTIF',
        'dipimpin_oleh' => 'Ketua Umum',
        'agenda' => 'Koordinasi program kerja.',
        'isi_rapat' => 'Pembahasan agenda dan tindak lanjut.',
        'attendees' => [
            [
                'name' => 'Peserta Satu',
                'nim' => '23552011001',
                'jabatan' => 'Anggota',
                'keterangan' => 'hadir',
                'order' => 0,
            ],
        ],
    ], $overrides);
}

function archivePayload(Division $division, array $overrides = []): array
{
    return array_merge([
        'name' => 'Arsip CRUD Dashboard',
        'type' => 'proposal',
        'division_id' => $division->id,
        'file' => UploadedFile::fake()->create('proposal.pdf', 64, 'application/pdf'),
        'share_enabled' => true,
        'share_expires_at' => now()->addWeek()->format('Y-m-d H:i:s'),
    ], $overrides);
}

function createAnnouncementRecord(array $overrides = []): Announcement
{
    static $sequence = 0;
    $sequence++;

    return Announcement::create(array_merge([
        'title' => "Pengumuman Bulk {$sequence}",
        'slug' => "pengumuman-bulk-{$sequence}",
        'body' => 'Isi pengumuman bulk.',
    ], $overrides));
}

function createActivityRecord(array $overrides = []): Activity
{
    static $sequence = 0;
    $sequence++;

    return Activity::create(array_merge([
        'title' => "Kegiatan Bulk {$sequence}",
        'slug' => "kegiatan-bulk-{$sequence}",
        'description' => 'Deskripsi kegiatan bulk.',
        'start_date' => now()->addDays($sequence),
        'status' => 'upcoming',
    ], $overrides));
}

function createProductCategoryRecord(array $overrides = []): ProductCategory
{
    static $sequence = 0;
    $sequence++;

    return ProductCategory::create(array_merge([
        'name' => "Kategori Bulk {$sequence}",
        'slug' => "kategori-bulk-{$sequence}",
    ], $overrides));
}

function createProductRecord(array $overrides = []): Product
{
    static $sequence = 0;
    $sequence++;

    return Product::create(array_merge([
        'name' => "Produk Bulk {$sequence}",
        'slug' => "produk-bulk-{$sequence}",
        'price' => 75000,
        'is_available' => true,
    ], $overrides));
}

function createDivisionRecord(array $overrides = []): Division
{
    static $sequence = 0;
    $sequence++;

    return Division::create(array_merge([
        'name' => "Divisi Bulk {$sequence}",
        'slug' => "divisi-bulk-{$sequence}",
        'order' => $sequence,
    ], $overrides));
}

function createStaffRecord(array $overrides = []): Staff
{
    static $sequence = 0;
    $sequence++;

    return Staff::create(array_merge([
        'name' => "Staff Bulk {$sequence}",
        'position' => 'Anggota',
        'order' => $sequence,
        'is_active' => true,
        'is_bph' => false,
    ], $overrides));
}

function createAspirationRecord(array $overrides = []): Aspiration
{
    static $sequence = 0;
    $sequence++;

    return Aspiration::create(array_merge([
        'subject' => "Aspirasi Dashboard {$sequence}",
        'message' => 'Isi aspirasi untuk test dashboard.',
        'tracking_code' => "ASPTEST{$sequence}",
        'status' => 'pending',
    ], $overrides));
}

it('covers dashboard home, announcements, and activities CRUD', function () {
    $this->get('/dashboard')->assertOk();

    $category = AnnouncementCategory::create([
        'name' => 'Akademik',
        'slug' => 'akademik',
    ]);

    $this->get('/dashboard/announcements')->assertOk();
    $this->get('/dashboard/announcements/create')->assertOk();

    $this->post('/dashboard/announcements', announcementPayload([
        'announcement_category_id' => $category->id,
    ]))->assertRedirect('/dashboard/announcements');

    $announcement = Announcement::where('slug', 'pengumuman-crud-dashboard')->firstOrFail();

    $this->get("/dashboard/announcements/{$announcement->id}/edit")->assertOk();
    $this->put("/dashboard/announcements/{$announcement->id}", announcementPayload([
        'announcement_category_id' => $category->id,
        'title' => 'Pengumuman CRUD Dashboard Updated',
    ]))->assertRedirect('/dashboard/announcements');

    $this->assertDatabaseHas('announcements', [
        'id' => $announcement->id,
        'title' => 'Pengumuman CRUD Dashboard Updated',
    ]);

    $bulkAnnouncements = collect([
        createAnnouncementRecord(),
        createAnnouncementRecord(),
    ]);
    $this->delete('/dashboard/announcements/bulk-delete', [
        'ids' => $bulkAnnouncements->pluck('id')->all(),
    ])->assertRedirect();

    foreach ($bulkAnnouncements as $bulkAnnouncement) {
        $this->assertDatabaseMissing('announcements', ['id' => $bulkAnnouncement->id]);
    }

    $this->delete("/dashboard/announcements/{$announcement->id}")
        ->assertRedirect('/dashboard/announcements');
    $this->assertDatabaseMissing('announcements', ['id' => $announcement->id]);

    $this->get('/dashboard/activities')->assertOk();
    $this->get('/dashboard/activities/create')->assertOk();

    $this->post('/dashboard/activities', activityPayload())
        ->assertRedirect('/dashboard/activities');

    $activity = Activity::where('slug', 'kegiatan-crud-dashboard')->firstOrFail();

    $this->get("/dashboard/activities/{$activity->id}/edit")->assertOk();
    $this->put("/dashboard/activities/{$activity->id}", activityPayload([
        'title' => 'Kegiatan CRUD Dashboard Updated',
        'status' => 'ongoing',
    ]))->assertRedirect('/dashboard/activities');

    $this->assertDatabaseHas('activities', [
        'id' => $activity->id,
        'title' => 'Kegiatan CRUD Dashboard Updated',
        'status' => 'ongoing',
    ]);

    $bulkActivities = collect([
        createActivityRecord(),
        createActivityRecord(),
    ]);
    $this->delete('/dashboard/activities/bulk-delete', [
        'ids' => $bulkActivities->pluck('id')->all(),
    ])->assertRedirect();

    foreach ($bulkActivities as $bulkActivity) {
        $this->assertDatabaseMissing('activities', ['id' => $bulkActivity->id]);
    }

    $this->delete("/dashboard/activities/{$activity->id}")
        ->assertRedirect('/dashboard/activities');
    $this->assertDatabaseMissing('activities', ['id' => $activity->id]);
});

it('covers product and product category CRUD', function () {
    $this->get('/dashboard/products/categories')->assertOk();
    $this->get('/dashboard/products/categories/create')->assertOk();

    $this->post('/dashboard/products/categories', [
        'name' => 'Merchandise',
        'slug' => 'merchandise',
    ])->assertRedirect('/dashboard/products/categories');

    $category = ProductCategory::where('slug', 'merchandise')->firstOrFail();

    $this->get("/dashboard/products/categories/{$category->id}/edit")->assertOk();
    $this->put("/dashboard/products/categories/{$category->id}", [
        'name' => 'Merchandise Updated',
        'slug' => 'merchandise-updated',
    ])->assertRedirect('/dashboard/products/categories');

    $this->assertDatabaseHas('product_categories', [
        'id' => $category->id,
        'slug' => 'merchandise-updated',
    ]);

    $bulkCategories = collect([
        createProductCategoryRecord(),
        createProductCategoryRecord(),
    ]);
    $this->delete('/dashboard/products/categories/bulk-delete', [
        'ids' => $bulkCategories->pluck('id')->all(),
    ])->assertRedirect();

    foreach ($bulkCategories as $bulkCategory) {
        $this->assertDatabaseMissing('product_categories', ['id' => $bulkCategory->id]);
    }

    $this->get('/dashboard/products')->assertOk();
    $this->get('/dashboard/products/create')->assertOk();

    $this->post('/dashboard/products', productPayload($category))
        ->assertRedirect('/dashboard/products');

    $product = Product::where('slug', 'produk-crud-dashboard')->firstOrFail();

    $this->get("/dashboard/products/{$product->id}/edit")->assertOk();
    $this->put("/dashboard/products/{$product->id}", productPayload($category, [
        'name' => 'Produk CRUD Dashboard Updated',
        'is_available' => false,
    ]))->assertRedirect('/dashboard/products');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Produk CRUD Dashboard Updated',
        'is_available' => false,
    ]);

    $this->patch('/dashboard/products/bulk-phone', [
        'phone_number' => '089999999999',
    ])->assertRedirect();

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'phone_number' => '089999999999',
    ]);

    $bulkProducts = collect([
        createProductRecord(['product_category_id' => $category->id]),
        createProductRecord(['product_category_id' => $category->id]),
    ]);
    $this->delete('/dashboard/products/bulk-delete', [
        'ids' => $bulkProducts->pluck('id')->all(),
    ])->assertRedirect();

    foreach ($bulkProducts as $bulkProduct) {
        $this->assertDatabaseMissing('products', ['id' => $bulkProduct->id]);
    }

    $this->delete("/dashboard/products/{$product->id}")
        ->assertRedirect('/dashboard/products');
    $this->assertDatabaseMissing('products', ['id' => $product->id]);

    $this->delete("/dashboard/products/categories/{$category->id}")
        ->assertRedirect('/dashboard/products/categories');
    $this->assertDatabaseMissing('product_categories', ['id' => $category->id]);
});

it('covers divisions, periods, and staff dashboard workflows', function () {
    $this->get('/dashboard/staffs/divisions')->assertOk();
    $this->get('/dashboard/staffs/divisions/create')->assertOk();

    $this->post('/dashboard/staffs/divisions', divisionPayload())
        ->assertRedirect('/dashboard/staffs/divisions');

    $division = Division::where('slug', 'kominfo-test')->firstOrFail();

    $this->get("/dashboard/staffs/divisions/{$division->id}/edit")->assertOk();
    $this->put("/dashboard/staffs/divisions/{$division->id}", divisionPayload([
        'name' => 'Kominfo Test Updated',
    ]))->assertRedirect('/dashboard/staffs/divisions');

    $this->assertDatabaseHas('divisions', [
        'id' => $division->id,
        'name' => 'Kominfo Test Updated',
    ]);

    $this->get('/dashboard/staffs/periods')->assertOk();
    $this->get('/dashboard/staffs/periods/create')->assertOk();

    $this->post('/dashboard/staffs/periods', periodPayload())
        ->assertRedirect('/dashboard/staffs/periods');

    $period = Period::where('label', '2026/2027')->firstOrFail();

    $this->get("/dashboard/staffs/periods/{$period->id}/edit")->assertOk();
    $this->put("/dashboard/staffs/periods/{$period->id}", periodPayload([
        'label' => '2027/2028',
    ]))->assertRedirect('/dashboard/staffs/periods');

    $period->refresh();
    $this->assertSame('2027/2028', $period->label);

    $this->get('/dashboard/staffs')->assertOk();
    $this->get('/dashboard/staffs/create')->assertOk();

    $this->post('/dashboard/staffs', [
        'period_id' => $period->id,
        'name' => 'Staff CRUD Dashboard',
        'position' => 'Koordinator',
        'division_id' => $division->id,
        'bio' => 'Bio staff dashboard.',
        'instagram' => '@staffdashboard',
        'linkedin' => 'https://linkedin.com/in/staffdashboard',
        'order' => 1,
        'is_active' => true,
        'is_bph' => false,
    ])->assertRedirect('/dashboard/staffs');

    $staff = Staff::where('name', 'Staff CRUD Dashboard')->firstOrFail();

    $this->assertDatabaseHas('staff_periods', [
        'period_id' => $period->id,
        'staff_id' => $staff->id,
        'division_id' => $division->id,
    ]);

    $this->get("/dashboard/staffs/{$staff->id}/edit")->assertOk();
    $this->put("/dashboard/staffs/{$staff->id}", [
        'period_id' => $period->id,
        'name' => 'Staff CRUD Dashboard Updated',
        'position' => 'Kepala Bidang',
        'division_id' => $division->id,
        'bio' => 'Bio staff dashboard updated.',
        'instagram' => '@staffdashboardupdated',
        'linkedin' => 'https://linkedin.com/in/staffdashboardupdated',
        'order' => 2,
        'is_active' => true,
        'is_bph' => true,
    ])->assertRedirect('/dashboard/staffs');

    $staff->refresh();
    $this->assertSame('Staff CRUD Dashboard Updated', $staff->name);

    $this->post('/dashboard/staffs/reorder', [
        'ids' => [$staff->id],
    ])->assertOk()->assertJson(['success' => true]);

    $this->assertDatabaseHas('staff_periods', [
        'staff_id' => $staff->id,
        'order' => 0,
    ]);

    $this->delete("/dashboard/staffs/{$staff->id}")
        ->assertRedirect('/dashboard/staffs');
    $this->assertDatabaseMissing('staff_periods', [
        'period_id' => $period->id,
        'staff_id' => $staff->id,
    ]);

    $bulkStaff = collect([
        createStaffRecord(['division_id' => $division->id, 'is_active' => true]),
        createStaffRecord(['division_id' => $division->id, 'is_active' => true]),
    ]);
    foreach ($bulkStaff as $index => $member) {
        StaffPeriod::create([
            'period_id' => $period->id,
            'staff_id' => $member->id,
            'division_id' => $division->id,
            'position' => 'Anggota',
            'order' => $index,
            'is_bph' => false,
            'is_active' => true,
        ]);
    }

    $this->delete('/dashboard/staffs/bulk-delete', [
        'ids' => $bulkStaff->pluck('id')->all(),
    ])->assertRedirect();

    foreach ($bulkStaff as $member) {
        $this->assertDatabaseMissing('staff_periods', [
            'period_id' => $period->id,
            'staff_id' => $member->id,
        ]);
    }

    StaffPeriod::create([
        'period_id' => $period->id,
        'staff_id' => $staff->id,
        'division_id' => $division->id,
        'position' => 'Koordinator',
        'order' => 0,
        'is_bph' => false,
        'is_active' => true,
    ]);

    $this->delete('/dashboard/staffs/truncate')
        ->assertRedirect('/dashboard/staffs');
    $this->assertDatabaseMissing('staff_periods', ['period_id' => $period->id]);

    $bulkDivisions = collect([
        createDivisionRecord(),
        createDivisionRecord(),
    ]);
    $this->delete('/dashboard/staffs/divisions/bulk-delete', [
        'ids' => $bulkDivisions->pluck('id')->all(),
    ])->assertRedirect();

    foreach ($bulkDivisions as $bulkDivision) {
        $this->assertDatabaseMissing('divisions', ['id' => $bulkDivision->id]);
    }

    $bulkPeriods = Period::query()->create([
        'label' => '2028/2029',
        'display_order' => 8,
        'is_active' => false,
    ]);
    $this->delete('/dashboard/staffs/periods/bulk-delete', [
        'ids' => [$bulkPeriods->id],
    ])->assertRedirect();
    $this->assertDatabaseMissing('periods', ['id' => $bulkPeriods->id]);

    $this->delete("/dashboard/staffs/periods/{$period->id}")
        ->assertRedirect('/dashboard/staffs/periods');
    $this->assertDatabaseMissing('periods', ['id' => $period->id]);

    $this->delete("/dashboard/staffs/divisions/{$division->id}")
        ->assertRedirect('/dashboard/staffs/divisions');
    $this->assertDatabaseMissing('divisions', ['id' => $division->id]);
});

it('covers minutes CRUD including attendees, show, and print views', function () {
    $division = createDivisionRecord([
        'order' => 1,
    ]);

    $this->get('/dashboard/minutes')->assertOk();
    $this->get('/dashboard/minutes/create')->assertOk();

    $this->post('/dashboard/minutes', minutePayload($division))
        ->assertRedirect('/dashboard/minutes');

    $minute = Minute::where('nomor', '001/HMTIF/VI/2026')->firstOrFail();

    $this->assertDatabaseHas('minute_attendees', [
        'minute_id' => $minute->id,
        'name' => 'Peserta Satu',
    ]);

    $this->get("/dashboard/minutes/{$minute->id}")->assertOk();
    $this->get("/dashboard/minutes/{$minute->id}/print")->assertOk();
    $this->get("/dashboard/minutes/{$minute->id}/edit")->assertOk();

    $this->put("/dashboard/minutes/{$minute->id}", minutePayload($division, [
        'nomor' => '002/HMTIF/VI/2026',
        'perihal' => 'Rapat Koordinasi Dashboard Updated',
        'attendees' => [
            [
                'name' => 'Peserta Dua',
                'nim' => '23552011002',
                'jabatan' => 'Sekretaris',
                'keterangan' => 'izin',
                'order' => 0,
            ],
        ],
    ]))->assertRedirect('/dashboard/minutes');

    $this->assertDatabaseHas('minutes', [
        'id' => $minute->id,
        'nomor' => '002/HMTIF/VI/2026',
        'perihal' => 'Rapat Koordinasi Dashboard Updated',
    ]);
    $this->assertDatabaseHas('minute_attendees', [
        'minute_id' => $minute->id,
        'name' => 'Peserta Dua',
        'keterangan' => 'izin',
    ]);

    $bulkMinutes = Minute::query()->create([
        'nomor' => '003/HMTIF/VI/2026',
        'perihal' => 'Bulk Notulensi',
        'tanggal' => now()->format('Y-m-d'),
        'waktu_mulai' => '13:00',
        'waktu_selesai' => '14:00',
        'tempat' => 'Sekretariat HMTIF',
        'dipimpin_oleh' => 'Ketua Umum',
        'agenda' => 'Agenda bulk.',
        'isi_rapat' => 'Isi bulk.',
    ]);
    $this->delete('/dashboard/minutes/bulk-delete', [
        'ids' => [$bulkMinutes->id],
    ])->assertRedirect();
    $this->assertDatabaseMissing('minutes', ['id' => $bulkMinutes->id]);

    $this->delete("/dashboard/minutes/{$minute->id}")
        ->assertRedirect('/dashboard/minutes');
    $this->assertDatabaseMissing('minutes', ['id' => $minute->id]);
});

it('covers archives CRUD and preview', function () {
    $division = createDivisionRecord([
        'order' => 1,
    ]);

    $this->get('/dashboard/archives')->assertOk();
    $this->get('/dashboard/archives/create')->assertOk();

    $this->post('/dashboard/archives', archivePayload($division))
        ->assertRedirect('/dashboard/archives');

    $archive = Archive::where('name', 'Arsip CRUD Dashboard')->firstOrFail();

    $this->get("/dashboard/archives/{$archive->id}")->assertOk();
    $this->get("/dashboard/archives/{$archive->id}/edit")->assertOk();
    $this->get("/dashboard/archives/{$archive->id}/preview")->assertOk();

    $oldPath = $archive->file_path;

    $this->put("/dashboard/archives/{$archive->id}", archivePayload($division, [
        'name' => 'Arsip CRUD Dashboard Updated',
        'type' => 'lpj',
        'file' => UploadedFile::fake()->create('lpj.pdf', 64, 'application/pdf'),
        'share_enabled' => false,
        'share_expires_at' => null,
    ]))->assertRedirect('/dashboard/archives');

    $archive->refresh();
    $this->assertSame('Arsip CRUD Dashboard Updated', $archive->name);
    $this->assertSame('lpj', $archive->type);
    Storage::disk('public')->assertMissing($oldPath);
    Storage::disk('public')->assertExists($archive->file_path);

    $bulkArchive = Archive::query()->create([
        'name' => 'Bulk Arsip',
        'type' => 'nota',
        'division_id' => $division->id,
        'file_path' => UploadedFile::fake()->create('nota.pdf', 64, 'application/pdf')->store('archives', 'public'),
        'file_name' => 'nota.pdf',
        'mime_type' => 'application/pdf',
        'file_size' => 64,
        'share_enabled' => false,
    ]);

    $this->delete('/dashboard/archives/bulk-delete', [
        'ids' => [$bulkArchive->id],
    ])->assertRedirect();
    $this->assertDatabaseMissing('archives', ['id' => $bulkArchive->id]);

    $this->delete("/dashboard/archives/{$archive->id}")
        ->assertRedirect('/dashboard/archives');
    $this->assertDatabaseMissing('archives', ['id' => $archive->id]);
});

it('covers aspirations dashboard review flow without sending email', function () {
    $aspiration = createAspirationRecord([
        'name' => 'Mahasiswa Test',
        'email' => 'mahasiswa@example.test',
        'status' => 'pending',
    ]);

    $this->get('/dashboard/aspirations')->assertOk();
    $this->get("/dashboard/aspirations/{$aspiration->id}")->assertOk();

    $this->put("/dashboard/aspirations/{$aspiration->id}/feedback", [
        'status' => 'resolved',
        'feedback' => 'Aspirasi sudah ditindaklanjuti oleh tim terkait.',
    ])->assertRedirect("/dashboard/aspirations/{$aspiration->id}");

    $this->assertDatabaseHas('aspirations', [
        'id' => $aspiration->id,
        'status' => 'resolved',
    ]);
});

it('covers users CRUD while setup email is mocked', function () {
    $division = createDivisionRecord();
    $staff = createStaffRecord([
        'division_id' => $division->id,
    ]);

    $this->get('/dashboard/users')->assertOk();
    $this->get('/dashboard/users/create')->assertOk();

    $this->post('/dashboard/users', [
        'email' => 'pengguna@example.test',
        'role' => 'staff',
        'staff_id' => $staff->id,
    ])->assertRedirect('/dashboard/users');

    $user = User::where('email', 'pengguna@example.test')->firstOrFail();

    $this->get("/dashboard/users/{$user->id}/edit")->assertOk();
    $this->put("/dashboard/users/{$user->id}", [
        'email' => 'pengguna-updated@example.test',
        'role' => 'koordinator',
        'staff_id' => $staff->id,
    ])->assertRedirect('/dashboard/users');

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'email' => 'pengguna-updated@example.test',
        'role' => 'koordinator',
    ]);

    $bulkUsers = User::factory()->count(2)->create([
        'role' => 'staff',
    ]);
    $this->delete('/dashboard/users/bulk-delete', [
        'ids' => $bulkUsers->pluck('id')->all(),
    ])->assertRedirect();

    foreach ($bulkUsers as $bulkUser) {
        $this->assertDatabaseMissing('users', ['id' => $bulkUser->id]);
    }

    $this->delete("/dashboard/users/{$user->id}")
        ->assertRedirect('/dashboard/users');
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

it('covers settings role CRUD and menu access updates', function () {
    $this->get('/dashboard/settings')->assertOk();

    $this->post('/dashboard/settings', [
        'name' => 'Reviewer',
        'perm_create' => true,
        'perm_read' => true,
        'perm_update' => false,
        'perm_delete' => false,
    ])->assertRedirect('/dashboard/settings');

    $role = Role::where('name', 'reviewer')->firstOrFail();

    $this->putJson("/dashboard/settings/{$role->id}", [
        'field' => 'can_update',
        'value' => true,
    ])->assertOk()->assertJson(['success' => true]);

    $this->patchJson("/dashboard/settings/{$role->id}/menu", [
        'menu_access' => ['dashboard', 'activities', 'announcements'],
    ])->assertOk()->assertJson(['success' => true]);

    $role->refresh();
    expect($role->can_update)->toBeTrue();
    expect($role->menu_access)->toBe(['dashboard', 'activities', 'announcements']);

    $bulkRole = Role::create([
        'name' => 'bulk-reviewer',
        'can_create' => false,
        'can_read' => true,
        'can_update' => false,
        'can_delete' => false,
    ]);

    $this->delete('/dashboard/settings/bulk-delete', [
        'ids' => [$bulkRole->id],
    ])->assertRedirect();
    $this->assertDatabaseMissing('roles', ['id' => $bulkRole->id]);

    $this->delete("/dashboard/settings/{$role->id}")
        ->assertRedirect('/dashboard/settings');
    $this->assertDatabaseMissing('roles', ['id' => $role->id]);
});

it('covers home sections, developer team content, activity logs, editor upload, and profile updates', function () {
    $this->get('/dashboard/home-sections')->assertOk();
    $this->get('/dashboard/home-sections/hero/edit')->assertOk();

    $this->put('/dashboard/home-sections/hero', [
        'headline' => 'HMTIF UNPAS',
        'subheadline' => 'Kabinet Test',
        'background_image' => 'images/hero-test.jpg',
    ])->assertRedirect('/dashboard/home-sections');

    $this->assertDatabaseHas('home_sections', [
        'section' => 'hero',
        'key' => 'headline',
        'value' => 'HMTIF UNPAS',
    ]);

    $division = createDivisionRecord();
    $staff = createStaffRecord([
        'division_id' => $division->id,
        'name' => 'Developer Staff',
        'is_active' => true,
    ]);
    $period = Period::create(periodPayload([
        'label' => '2029/2030',
        'display_order' => 9,
    ]));

    $this->get('/dashboard/developer-teams')->assertOk();
    $this->put('/dashboard/developer-teams', [
        'period' => $period->label,
        'title' => 'Tim Pengembang Dashboard',
        'description' => 'Deskripsi tim pengembang.',
        'members' => [
            [
                'staff_id' => $staff->id,
                'role' => 'Frontend Engineer',
            ],
        ],
        'milestones' => [
            [
                'period' => $period->label,
                'title' => 'Rilis Dashboard',
                'description' => 'Rilis fitur dashboard.',
                'status' => 'current',
            ],
        ],
    ])->assertRedirect();

    $this->assertDatabaseHas('developer_team_settings', [
        'title' => 'Tim Pengembang Dashboard',
    ]);
    $this->assertDatabaseHas('developer_team_members', [
        'period_id' => $period->id,
        'staff_id' => $staff->id,
        'role' => 'Frontend Engineer',
    ]);
    $this->assertDatabaseHas('developer_team_milestones', [
        'period_id' => $period->id,
        'title' => 'Rilis Dashboard',
        'status' => 'current',
    ]);

    $this->delete('/dashboard/developer-teams/period', [
        'period' => $period->label,
    ])->assertRedirect('/dashboard/developer-teams');

    expect(DeveloperTeamSetting::count())->toBe(1);
    expect(DeveloperTeamMember::where('period_id', $period->id)->count())->toBe(0);
    expect(DeveloperTeamMilestone::where('period_id', $period->id)->count())->toBe(0);

    $activityLog = ActivityLog::create([
        'user_id' => $this->admin->id,
        'action' => 'updated',
        'model_type' => User::class,
        'model_id' => $this->admin->id,
        'description' => 'Log test dashboard.',
    ]);

    $this->get('/dashboard/activity-logs')->assertOk();
    $this->delete('/dashboard/activity-logs/bulk-delete', [
        'ids' => [$activityLog->id],
    ])->assertRedirect();
    $this->assertDatabaseMissing('activity_logs', ['id' => $activityLog->id]);

    $this->postJson('/dashboard/editor/upload', [
        'image' => UploadedFile::fake()->image('editor.png'),
    ])->assertOk()->assertJsonStructure(['url']);

    $profileUser = User::factory()->create([
        'email' => 'profile@example.test',
        'password' => Hash::make('OldPassword123!'),
        'role' => 'admin',
        'staff_id' => $staff->id,
    ]);

    $this->actingAs($profileUser);

    $this->get('/dashboard/profile')->assertOk();
    $this->put('/dashboard/profile', [
        'email' => 'profile-updated@example.test',
        'bio' => 'Bio profil update.',
        'instagram' => '@profileupdated',
        'linkedin' => 'https://linkedin.com/in/profileupdated',
        'photo_file' => UploadedFile::fake()->image('profile.jpg'),
    ])->assertRedirect();

    $this->assertDatabaseHas('users', [
        'id' => $profileUser->id,
        'email' => 'profile-updated@example.test',
    ]);
    $this->assertDatabaseHas('staffs', [
        'id' => $staff->id,
        'bio' => 'Bio profil update.',
        'instagram' => '@profileupdated',
    ]);

    $this->put('/dashboard/profile/password', [
        'old_password' => 'OldPassword123!',
        'password' => 'NewPassword123!',
        'password_confirmation' => 'NewPassword123!',
    ])->assertRedirect();

    expect(Hash::check('NewPassword123!', $profileUser->fresh()->password))->toBeTrue();
});
