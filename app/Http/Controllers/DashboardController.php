<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Aspiration;
use App\Models\Division;
use App\Models\Minute;
use App\Models\MinuteAttendee;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $stats = Stat::orderBy('order')->get();

        $counts = [
            'users'         => User::count(),
            'announcements' => Announcement::count(),
            'activities'    => Activity::count(),
            'products'      => Product::count(),
            'aspirations'   => Aspiration::count(),
            'staff'         => Staff::count(),
        ];

        $recentAnnouncements = Announcement::latest('published_at')
            ->limit(5)
            ->get(['id', 'title', 'published_at', 'slug']);

        $recentActivities = Activity::latest('created_at')
            ->limit(5)
            ->get(['id', 'title', 'start_date', 'slug']);

        $recentAspirations = Aspiration::latest('created_at')
            ->limit(5)
            ->get(['id', 'subject', 'created_at', 'status']);

        return view('dashboard.index', [
            'user'                  => $user,
            'stats'                 => $stats,
            'counts'                => $counts,
            'recentAnnouncements'   => $recentAnnouncements,
            'recentActivities'      => $recentActivities,
            'recentAspirations'     => $recentAspirations,
        ]);
    }

    public function announcements(Request $request)
    {
        $announcements = Announcement::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('announcement_category_id', $request->category))
            ->latest('published_at')
            ->paginate(10);

        $categories = AnnouncementCategory::all();

        return view('dashboard.announcements.index', compact('announcements', 'categories'));
    }

    public function createAnnouncement()
    {
        $categories = AnnouncementCategory::all();

        return view('dashboard.announcements.create', compact('categories'));
    }

    public function storeAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:announcements,slug',
            'announcement_category_id' => 'nullable|exists:announcement_categories,id',
            'excerpt' => 'nullable|string|max:1024',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1024',
            'published_at' => 'nullable|date',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('announcements/files', 'public');
        }

        Announcement::create($validated);

        return redirect()->route('dashboard.announcements')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function editAnnouncement(Announcement $announcement)
    {
        $categories = AnnouncementCategory::all();

        return view('dashboard.announcements.edit', compact('announcement', 'categories'));
    }

    public function updateAnnouncement(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:announcements,slug,{$announcement->id}",
            'announcement_category_id' => 'nullable|exists:announcement_categories,id',
            'excerpt' => 'nullable|string|max:1024',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1024',
            'published_at' => 'nullable|date',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file')) {
            if ($announcement->file) {
                Storage::disk('public')->delete($announcement->file);
            }
            $validated['file'] = $request->file('file')->store('announcements/files', 'public');
        }

        $announcement->update($validated);

        return redirect()->route('dashboard.announcements')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroyAnnouncement(Announcement $announcement)
    {
        if ($announcement->file) {
            Storage::disk('public')->delete($announcement->file);
        }

        $announcement->delete();

        return redirect()->route('dashboard.announcements')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function activities(Request $request)
    {
        $activities = Activity::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest('created_at')
            ->paginate(10);

        return view('dashboard.activities.index', compact('activities'));
    }

    public function createActivity()
    {
        return view('dashboard.activities.create');
    }

    public function storeActivity(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:activities,slug',
            'description' => 'required|string',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1024',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'registration_url' => 'nullable|url|max:1024',
            'status' => 'required|in:upcoming,ongoing,past',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('activities/files', 'public');
        }

        Activity::create($validated);

        return redirect()->route('dashboard.activities')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function editActivity(Activity $activity)
    {
        return view('dashboard.activities.edit', compact('activity'));
    }

    public function updateActivity(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:activities,slug,{$activity->id}",
            'description' => 'required|string',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:1024',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'registration_url' => 'nullable|url|max:1024',
            'status' => 'required|in:upcoming,ongoing,past',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file')) {
            if ($activity->file) {
                Storage::disk('public')->delete($activity->file);
            }
            $validated['file'] = $request->file('file')->store('activities/files', 'public');
        }

        $activity->update($validated);

        return redirect()->route('dashboard.activities')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroyActivity(Activity $activity)
    {
        if ($activity->file) {
            Storage::disk('public')->delete($activity->file);
        }

        $activity->delete();

        return redirect()->route('dashboard.activities')->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function staffs(Request $request)
    {
        $divisions = Division::with(['staffs' => function ($query) use ($request) {
            $query->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"));
        }])
            ->when($request->division, fn($q) => $q->where('id', $request->division))
            ->orderBy('order')
            ->get();

        return view('dashboard.staffs.index', compact('divisions'));
    }

    public function createStaff()
    {
        $divisions = Division::orderBy('order')->get();
        $users = User::orderBy('name')->get();

        return view('dashboard.staffs.create', compact('divisions', 'users'));
    }

    public function storeStaff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'user_id' => 'nullable|exists:users,id',
            'photo' => 'nullable|url|max:1024',
            'bio' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:1024',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_bph' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? (bool) $validated['is_active'] : false;
        $validated['is_bph'] = $request->has('is_bph') ? (bool) $validated['is_bph'] : false;

        Staff::create($validated);

        return redirect()->route('dashboard.staffs')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function editStaff(Staff $staff)
    {
        $divisions = Division::orderBy('order')->get();
        $users = User::orderBy('name')->get();

        return view('dashboard.staffs.edit', compact('staff', 'divisions', 'users'));
    }

    public function updateStaff(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'user_id' => 'nullable|exists:users,id',
            'photo' => 'nullable|url|max:1024',
            'bio' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:1024',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_bph' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? (bool) $validated['is_active'] : false;
        $validated['is_bph'] = $request->has('is_bph') ? (bool) $validated['is_bph'] : false;

        $staff->update($validated);

        return redirect()->route('dashboard.staffs')->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroyStaff(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('dashboard.staffs')->with('success', 'Pengurus berhasil dihapus.');
    }

    public function divisions(Request $request)
    {
        $divisions = Division::withCount('staffs')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->orderBy('order')
            ->paginate(10);

        return view('dashboard.staffs.divisions.index', compact('divisions'));
    }

    public function storeDivision(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:divisions,slug',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        Division::create($validated);

        return redirect()->route('dashboard.staffs.divisions')->with('success', 'Divisi berhasil ditambahkan.');
    }

    public function editDivision(Division $division)
    {
        return view('dashboard.staffs.divisions.edit', compact('division'));
    }

    public function updateDivision(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:divisions,slug,{$division->id}",
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $division->update($validated);

        return redirect()->route('dashboard.staffs.divisions')->with('success', 'Divisi berhasil diperbarui.');
    }

    public function destroyDivision(Division $division)
    {
        $division->delete();

        return redirect()->route('dashboard.staffs.divisions')->with('success', 'Divisi berhasil dihapus.');
    }

    public function products(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('product_category_id', $request->category))
            ->latest('created_at')
            ->paginate(10);

        $categories = ProductCategory::orderBy('name')->get();

        return view('dashboard.products.index', compact('products', 'categories'));
    }

    public function createProduct()
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('dashboard.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'phone_number' => 'nullable|string|max:255',
            'order_text' => 'nullable|string',
            'is_available' => 'boolean',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*.id' => 'nullable|integer',
            'images.*.image_path' => 'nullable|string|max:1024',
            'images.*.order' => 'nullable|integer',
            'images.*.is_primary' => 'sometimes|boolean',
        ]);

        $validated['is_available'] = $request->boolean('is_available', true);

        $product = Product::create($validated);

        if (! empty($validated['images'])) {
            $this->syncProductImages($product, $validated['images']);
        }

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProduct(Product $product)
    {
        $categories = ProductCategory::orderBy('name')->get();

        $product->load('images');

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:products,slug,{$product->id}",
            'product_category_id' => 'nullable|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'phone_number' => 'nullable|string|max:255',
            'order_text' => 'nullable|string',
            'is_available' => 'boolean',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*.id' => 'nullable|integer',
            'images.*.image_path' => 'nullable|string|max:1024',
            'images.*.order' => 'nullable|integer',
            'images.*.is_primary' => 'sometimes|boolean',
        ]);

        $validated['is_available'] = $request->boolean('is_available');

        $product->update($validated);

        $this->syncProductImages($product, $validated['images'] ?? []);

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil dihapus.');
    }

    public function productCategories(Request $request)
    {
        $categories = ProductCategory::withCount('products')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->orderBy('name')
            ->paginate(10);

        return view('dashboard.products.categories.index', compact('categories'));
    }

    public function createProductCategory()
    {
        return view('dashboard.products.categories.create');
    }

    public function storeProductCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug',
        ]);

        ProductCategory::create($validated);

        return redirect()->route('dashboard.products.categories')->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    public function editProductCategory(ProductCategory $category)
    {
        return view('dashboard.products.categories.edit', compact('category'));
    }

    public function updateProductCategory(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:product_categories,slug,{$category->id}",
        ]);

        $category->update($validated);

        return redirect()->route('dashboard.products.categories')->with('success', 'Kategori produk berhasil diperbarui.');
    }

    public function destroyProductCategory(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('dashboard.products.categories')->with('success', 'Kategori produk berhasil dihapus.');
    }

    private function syncProductImages(Product $product, array $images): void
    {
        $existingImageIds = $product->images()->pluck('id')->all();
        $submittedImageIds = [];

        foreach ($images as $imageData) {
            if (empty($imageData['image_path'])) {
                continue;
            }

            $imageData['is_primary'] = isset($imageData['is_primary']) && (bool) $imageData['is_primary'];
            $imageData['order'] = isset($imageData['order']) ? (int) $imageData['order'] : 0;

            if (! empty($imageData['id']) && in_array($imageData['id'], $existingImageIds, true)) {
                $submittedImageIds[] = $imageData['id'];
                $product->images()->where('id', $imageData['id'])->update([
                    'image_path' => $imageData['image_path'],
                    'order' => $imageData['order'],
                    'is_primary' => $imageData['is_primary'],
                ]);
                continue;
            }

            $created = $product->images()->create([
                'image_path' => $imageData['image_path'],
                'order' => $imageData['order'],
                'is_primary' => $imageData['is_primary'],
            ]);

            $submittedImageIds[] = $created->id;
        }

        if (empty($submittedImageIds)) {
            $product->images()->delete();
            return;
        }

        $product->images()->whereNotIn('id', $submittedImageIds)->delete();
    }

    public function aspirations(Request $request)
    {
        $aspirations = Aspiration::query()
            ->when($request->search, fn($q) => $q->where('subject', 'like', "%{$request->search}%"))
            ->latest('created_at')
            ->paginate(10);

        return view('dashboard.aspirations.index', compact('aspirations'));
    }

    public function stats(Request $request)
    {
        $stats = Stat::orderBy('order')->paginate(10);

        return view('dashboard.stats.index', compact('stats'));
    }

    public function createStat()
    {
        return view('dashboard.stats.create');
    }

    public function settings(Request $request)
    {
        $settings = Setting::query()
            ->when($request->search, fn($q) => $q->where('key', 'like', "%{$request->search}%")->orWhere('value', 'like', "%{$request->search}%"))
            ->when($request->group, fn($q) => $q->where('group', $request->group))
            ->latest('id')
            ->paginate(10);

        return view('dashboard.settings.index', compact('settings'));
    }

    public function createSetting()
    {
        return view('dashboard.settings.create');
    }

    public function storeSetting(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'required|string',
            'group' => 'required|string|max:255',
        ]);

        Setting::create($validated);

        return redirect()->route('dashboard.settings')->with('success', 'Pengaturan berhasil ditambahkan.');
    }

    public function editSetting(Setting $setting)
    {
        return view('dashboard.settings.edit', compact('setting'));
    }

    public function updateSetting(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'key' => "required|string|max:255|unique:settings,key,{$setting->id}",
            'value' => 'required|string',
            'group' => 'required|string|max:255',
        ]);

        $setting->update($validated);

        return redirect()->route('dashboard.settings')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function destroySetting(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('dashboard.settings')->with('success', 'Pengaturan berhasil dihapus.');
    }

    public function storeStat(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        Stat::create($validated);

        return redirect()->route('dashboard.stats')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function editStat(Stat $stat)
    {
        return view('dashboard.stats.edit', compact('stat'));
    }

    public function updateStat(Request $request, Stat $stat)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $stat->update($validated);

        return redirect()->route('dashboard.stats')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroyStat(Stat $stat)
    {
        $stat->delete();

        return redirect()->route('dashboard.stats')->with('success', 'Statistik berhasil dihapus.');
    }

    public function minutes(Request $request)
    {
        $minutes = Minute::query()
            ->when($request->search, fn($q) => $q->where('nomor', 'like', "%{$request->search}%")->orWhere('perihal', 'like', "%{$request->search}%"))
            ->latest('tanggal')
            ->paginate(10);

        return view('dashboard.minutes.index', compact('minutes'));
    }

    public function createMinute()
    {
        return view('dashboard.minutes.create');
    }

    public function storeMinute(Request $request)
    {
        $validated = $request->validate([
            'nomor' => 'required|string|max:255|unique:minutes,nomor',
            'perihal' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'tempat' => 'nullable|string|max:255',
            'dipimpin_oleh' => 'nullable|string|max:255',
            'agenda' => 'nullable|string',
            'isi_rapat' => 'nullable|string',
            'dokumentasi_file' => 'nullable|file|max:10240',
            'attendees' => 'nullable|array',
            'attendees.*.name' => 'nullable|string|max:255',
            'attendees.*.nim' => 'nullable|string|max:255',
            'attendees.*.jabatan' => 'nullable|string|max:255',
            'attendees.*.keterangan' => 'nullable|string|in:hadir,izin,alpha',
            'attendees.*.order' => 'nullable|integer',
        ]);

        if ($request->hasFile('dokumentasi_file')) {
            $validated['dokumentasi_file'] = $request->file('dokumentasi_file')->store('minutes/files', 'public');
        }

        $minute = Minute::create($validated);

        if (! empty($validated['attendees'])) {
            $this->syncMinuteAttendees($minute, $validated['attendees']);
        }

        return redirect()->route('dashboard.minutes')->with('success', 'Notulensi berhasil ditambahkan.');
    }

    public function editMinute(Minute $minute)
    {
        $minute->load('attendees');

        return view('dashboard.minutes.edit', compact('minute'));
    }

    public function updateMinute(Request $request, Minute $minute)
    {
        $validated = $request->validate([
            'nomor' => "required|string|max:255|unique:minutes,nomor,{$minute->id}",
            'perihal' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'tempat' => 'nullable|string|max:255',
            'dipimpin_oleh' => 'nullable|string|max:255',
            'agenda' => 'nullable|string',
            'isi_rapat' => 'nullable|string',
            'dokumentasi_file' => 'nullable|file|max:10240',
            'attendees' => 'nullable|array',
            'attendees.*.id' => 'nullable|integer',
            'attendees.*.name' => 'nullable|string|max:255',
            'attendees.*.nim' => 'nullable|string|max:255',
            'attendees.*.jabatan' => 'nullable|string|max:255',
            'attendees.*.keterangan' => 'nullable|string|in:hadir,izin,alpha',
            'attendees.*.order' => 'nullable|integer',
        ]);

        if ($request->hasFile('dokumentasi_file')) {
            if ($minute->dokumentasi_file) {
                Storage::disk('public')->delete($minute->dokumentasi_file);
            }
            $validated['dokumentasi_file'] = $request->file('dokumentasi_file')->store('minutes/files', 'public');
        }

        $minute->update($validated);

        $this->syncMinuteAttendees($minute, $validated['attendees'] ?? []);

        return redirect()->route('dashboard.minutes')->with('success', 'Notulensi berhasil diperbarui.');
    }

    public function destroyMinute(Minute $minute)
    {
        if ($minute->dokumentasi_file) {
            Storage::disk('public')->delete($minute->dokumentasi_file);
        }

        $minute->delete();

        return redirect()->route('dashboard.minutes')->with('success', 'Notulensi berhasil dihapus.');
    }

    private function syncMinuteAttendees(Minute $minute, array $attendees): void
    {
        $existingAttendeeIds = $minute->attendees()->pluck('id')->all();
        $submittedAttendeeIds = [];

        foreach ($attendees as $attendeeData) {
            if (empty($attendeeData['name'])) {
                continue;
            }

            $attendeeData['order'] = isset($attendeeData['order']) ? (int) $attendeeData['order'] : 0;
            $attendeeData['keterangan'] = $attendeeData['keterangan'] ?? 'hadir';

            if (! empty($attendeeData['id']) && in_array($attendeeData['id'], $existingAttendeeIds, true)) {
                $submittedAttendeeIds[] = $attendeeData['id'];
                $minute->attendees()->where('id', $attendeeData['id'])->update([
                    'name' => $attendeeData['name'],
                    'nim' => $attendeeData['nim'] ?? null,
                    'jabatan' => $attendeeData['jabatan'] ?? null,
                    'keterangan' => $attendeeData['keterangan'],
                    'order' => $attendeeData['order'],
                ]);
                continue;
            }

            $created = $minute->attendees()->create([
                'name' => $attendeeData['name'],
                'nim' => $attendeeData['nim'] ?? null,
                'jabatan' => $attendeeData['jabatan'] ?? null,
                'keterangan' => $attendeeData['keterangan'],
                'order' => $attendeeData['order'],
            ]);

            $submittedAttendeeIds[] = $created->id;
        }

        if (empty($submittedAttendeeIds)) {
            $minute->attendees()->delete();
            return;
        }

        $minute->attendees()->whereNotIn('id', $submittedAttendeeIds)->delete();
    }

    public function users(Request $request)
    {
        $users = User::query()
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%")->orWhere('email', 'like', "%{$request->search}%"))
            ->when($request->role, fn($q) => $q->where('role', $request->role))
            ->latest('created_at')
            ->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    public function createUser()
    {
        $staffOptions = Staff::orderBy('name')->get()->mapWithKeys(fn ($staff) => [$staff->id => $staff->name])->toArray();

        return view('dashboard.users.create', compact('staffOptions'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,bph,koordinator,staff',
            'staff_id' => 'nullable|exists:staffs,id',
        ]);

        User::create($validated);

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function editUser(User $user)
    {
        $staffOptions = Staff::orderBy('name')->get()->mapWithKeys(fn ($staff) => [$staff->id => $staff->name])->toArray();

        return view('dashboard.users.edit', compact('user', 'staffOptions'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$user->id}",
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,bph,koordinator,staff',
            'staff_id' => 'nullable|exists:staffs,id',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.users')->with('success', 'Pengguna berhasil dihapus.');
    }
}
