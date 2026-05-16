<?php

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardAnnouncementController;
use App\Http\Controllers\DashboardActivityController;
use App\Http\Controllers\DashboardAspirationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardDivisionController;
use App\Http\Controllers\DashboardMinuteController;
use App\Http\Controllers\DashboardProductCategoryController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardActivityLogController;
use App\Http\Controllers\DashboardStaffController;
use App\Http\Controllers\DashboardStatController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardHomeSectionController;
use App\Services\Activity\GetActivityBySlugService;
use App\Services\Activity\GetAllActivitiesService;
use App\Services\Announcement\GetAllAnnouncementsService;
use App\Services\Announcement\GetAnnouncementBySlugService;
use App\Services\Announcement\GetAnnouncementCategoriesService;
use App\Services\Aspiration\GetWeeklySpotlightService;
use App\Services\Home\GetActivitiesPreviewService;
use App\Services\Home\GetAnnouncementsPreviewService;
use App\Services\Home\GetHomeStatsService;
use App\Services\Staff\GetAllStaffsService;
use App\Services\Staff\GetDivisionBySlugService;
use App\Services\Staff\GetDivisionsService;
use App\Services\Staff\GetStaffByIdService;
use App\Services\Store\GetAllProductsService;
use App\Services\Store\GetProductBySlugService;
use App\Services\Store\GetProductCategoriesService;
use App\Services\Store\GetRelatedProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function (GetHomeStatsService $getStats, GetActivitiesPreviewService $getActivities, GetAnnouncementsPreviewService $getAnnouncements, ) {
    return view('pages.home', [
        'stats' => $getStats->execute(),
        'activities' => $getActivities->execute(),
        'announcements' => $getAnnouncements->execute(),
    ]);
})->name('home');

Route::get('/staff', function (GetAllStaffsService $getStaffs, GetDivisionsService $getDivisions, ) {
    return view('pages.staff', [
        'staffs' => $getStaffs->execute(),
        'divisions' => $getDivisions->execute(),
    ]);
})->name('staff');

Route::get('/staff/{id}', function (int $id, GetStaffByIdService $getStaff) {
    $staff = $getStaff->execute($id);

    return view('pages.staff-detail', compact('staff'));
})->name('staff.show')->where('id', '[0-9]+');

Route::get('/divisi/{slug}', function (string $slug, GetDivisionBySlugService $getDivision) {
    $division = $getDivision->execute($slug);

    return view('pages.division-detail', compact('division'));
})->name('divisions.show');

Route::get('/activities', function (Request $request, GetAllActivitiesService $getActivities, GetAllAnnouncementsService $getAnnouncements, ) {
    $activities = $getActivities->execute($request->query('status'));

    return view('pages.activities', [
        'activities' => $activities,
        'upcomingActivities' => (new GetAllActivitiesService())->execute('upcoming'),
        'announcements' => $getAnnouncements->execute(),
    ]);
})->name('activities');

Route::get('/activities/{slug}', function (string $slug, GetActivityBySlugService $getActivity) {
    $activity = $getActivity->execute($slug);

    return view('pages.activity-detail', compact('activity'));
})->name('activities.show');

Route::get('/store', function (Request $request, GetAllProductsService $getProducts, GetProductCategoriesService $getCategories) {
    $products = $getProducts->execute($request->query('category'));

    return view('pages.store', [
        'products' => $products,
        'categories' => $getCategories->execute(),
    ]);
})->name('store');

Route::get('/store/{slug}', function (string $slug, GetProductBySlugService $getProduct, GetRelatedProductsService $getRelated, ) {
    $product = $getProduct->execute($slug);

    return view('pages.product-detail', [
        'product' => $product,
        'related' => $getRelated->execute($product),
    ]);
})->name('store.show');

Route::get('/announcements', function (Request $request, GetAllAnnouncementsService $getAnnouncements, GetAnnouncementCategoriesService $getCategories, ) {
    $announcements = $getAnnouncements->execute(
        $request->query('category_id') ? (int) $request->query('category_id') : null,
        $request->query('search')
    );

    return view('pages.announcements', [
        'announcements' => $announcements,
        'categories' => $getCategories->execute(),
    ]);
})->name('announcements');

Route::get('/announcements/{slug}', function (string $slug, GetAnnouncementBySlugService $getAnnouncement) {
    $announcement = $getAnnouncement->execute($slug);

    return view('pages.announcement-detail', compact('announcement'));
})->name('announcements.show');

Route::get('/aspirations', function (GetWeeklySpotlightService $getSpotlight) {
    return view('pages.aspirations', [
        'spotlight' => $getSpotlight->execute(),
    ]);
})->name('aspirations');

Route::post('/aspirations', [AspirationController::class, 'storeWeb'])
    ->name('aspirations.store');

Route::get('/setup-password/{token}', function ($token) {
    return view('mail.setup-password-form', ['token' => $token]);
})->name('setup-password');

Route::post('/setup-password', function () {
    // BE: validate token, set password, redirect
    return redirect()->route('setup-password.success', ['email' => request('email')]);
})->name('setup-password.store');

Route::get('/setup-password-success', function () {
    return view('mail.setup-password-success', ['email' => request('email')]);
})->name('setup-password.success');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/announcements', [DashboardAnnouncementController::class, 'index'])->name('dashboard.announcements');
    Route::get('/announcements/create', [DashboardAnnouncementController::class, 'create'])->name('dashboard.announcements.create');
    Route::post('/announcements', [DashboardAnnouncementController::class, 'store'])->name('dashboard.announcements.store');
    Route::get('/announcements/{announcement}/edit', [DashboardAnnouncementController::class, 'edit'])->name('dashboard.announcements.edit');
    Route::put('/announcements/{announcement}', [DashboardAnnouncementController::class, 'update'])->name('dashboard.announcements.update');
    Route::delete('/announcements/{announcement}', [DashboardAnnouncementController::class, 'destroy'])->name('dashboard.announcements.destroy');

    Route::get('/activities', [DashboardActivityController::class, 'index'])->name('dashboard.activities');
    Route::get('/activities/create', [DashboardActivityController::class, 'create'])->name('dashboard.activities.create');
    Route::post('/activities', [DashboardActivityController::class, 'store'])->name('dashboard.activities.store');
    Route::get('/activities/{activity}/edit', [DashboardActivityController::class, 'edit'])->name('dashboard.activities.edit');
    Route::put('/activities/{activity}', [DashboardActivityController::class, 'update'])->name('dashboard.activities.update');
    Route::delete('/activities/{activity}', [DashboardActivityController::class, 'destroy'])->name('dashboard.activities.destroy');

    Route::get('/staffs', [DashboardStaffController::class, 'index'])->name('dashboard.staffs');
    Route::get('/staffs/create', [DashboardStaffController::class, 'create'])->name('dashboard.staffs.create');
    Route::post('/staffs', [DashboardStaffController::class, 'store'])->name('dashboard.staffs.store');
    Route::get('/staffs/{staff}/edit', [DashboardStaffController::class, 'edit'])->name('dashboard.staffs.edit');
    Route::put('/staffs/{staff}', [DashboardStaffController::class, 'update'])->name('dashboard.staffs.update');
    Route::delete('/staffs/{staff}', [DashboardStaffController::class, 'destroy'])->name('dashboard.staffs.destroy');

    Route::get('/staffs/divisions', [DashboardDivisionController::class, 'index'])->name('dashboard.staffs.divisions');
    Route::post('/staffs/divisions', [DashboardDivisionController::class, 'store'])->name('dashboard.staffs.divisions.store');
    Route::get('/staffs/divisions/{division}/edit', [DashboardDivisionController::class, 'edit'])->name('dashboard.staffs.divisions.edit');
    Route::put('/staffs/divisions/{division}', [DashboardDivisionController::class, 'update'])->name('dashboard.staffs.divisions.update');
    Route::delete('/staffs/divisions/{division}', [DashboardDivisionController::class, 'destroy'])->name('dashboard.staffs.divisions.destroy');

    Route::get('/products', [DashboardProductController::class, 'index'])->name('dashboard.products');
    Route::get('/products/create', [DashboardProductController::class, 'create'])->name('dashboard.products.create');
    Route::post('/products', [DashboardProductController::class, 'store'])->name('dashboard.products.store');
    Route::get('/products/{product}/edit', [DashboardProductController::class, 'edit'])->name('dashboard.products.edit');
    Route::put('/products/{product}', [DashboardProductController::class, 'update'])->name('dashboard.products.update');
    Route::delete('/products/{product}', [DashboardProductController::class, 'destroy'])->name('dashboard.products.destroy');

    Route::get('/products/categories', [DashboardProductCategoryController::class, 'index'])->name('dashboard.products.categories');
    Route::get('/products/categories/create', [DashboardProductCategoryController::class, 'create'])->name('dashboard.products.categories.create');
    Route::post('/products/categories', [DashboardProductCategoryController::class, 'store'])->name('dashboard.products.categories.store');
    Route::get('/products/categories/{category}/edit', [DashboardProductCategoryController::class, 'edit'])->name('dashboard.products.categories.edit');
    Route::put('/products/categories/{category}', [DashboardProductCategoryController::class, 'update'])->name('dashboard.products.categories.update');
    Route::delete('/products/categories/{category}', [DashboardProductCategoryController::class, 'destroy'])->name('dashboard.products.categories.destroy');

    Route::get('/aspirations', [DashboardAspirationController::class, 'index'])->name('dashboard.aspirations');

    Route::get('/stats', [DashboardStatController::class, 'index'])->name('dashboard.stats');
    Route::get('/stats/create', [DashboardStatController::class, 'create'])->name('dashboard.stats.create');
    Route::post('/stats', [DashboardStatController::class, 'store'])->name('dashboard.stats.store');
    Route::get('/stats/{stat}/edit', [DashboardStatController::class, 'edit'])->name('dashboard.stats.edit');
    Route::put('/stats/{stat}', [DashboardStatController::class, 'update'])->name('dashboard.stats.update');
    Route::delete('/stats/{stat}', [DashboardStatController::class, 'destroy'])->name('dashboard.stats.destroy');

    Route::get('/minutes', [DashboardMinuteController::class, 'index'])->name('dashboard.minutes');
    Route::get('/minutes/create', [DashboardMinuteController::class, 'create'])->name('dashboard.minutes.create');
    Route::post('/minutes', [DashboardMinuteController::class, 'store'])->name('dashboard.minutes.store');
    Route::get('/minutes/{minute}/edit', [DashboardMinuteController::class, 'edit'])->name('dashboard.minutes.edit');
    Route::put('/minutes/{minute}', [DashboardMinuteController::class, 'update'])->name('dashboard.minutes.update');
    Route::delete('/minutes/{minute}', [DashboardMinuteController::class, 'destroy'])->name('dashboard.minutes.destroy');

    Route::get('/home-sections', [DashboardHomeSectionController::class, 'index'])->name('dashboard.home-sections.index');
    Route::get('/home-sections/{section}/edit', [DashboardHomeSectionController::class, 'edit'])->name('dashboard.home-sections.edit');
    Route::put('/home-sections/{section}', [DashboardHomeSectionController::class, 'update'])->name('dashboard.home-sections.update');


    Route::get('/activity-logs', [DashboardActivityLogController::class, 'index'])->name('dashboard.activity-logs');
    Route::get('/activity-logs/create', [DashboardActivityLogController::class, 'create'])->name('dashboard.activity-logs.create');
    Route::post('/activity-logs', [DashboardActivityLogController::class, 'store'])->name('dashboard.activity-logs.store');
    Route::get('/activity-logs/{activityLog}/edit', [DashboardActivityLogController::class, 'edit'])->name('dashboard.activity-logs.edit');
    Route::put('/activity-logs/{activityLog}', [DashboardActivityLogController::class, 'update'])->name('dashboard.activity-logs.update');
    Route::delete('/activity-logs/{activityLog}', [DashboardActivityLogController::class, 'destroy'])->name('dashboard.activity-logs.destroy');

    Route::get('/users', [DashboardUserController::class, 'index'])->name('dashboard.users');
    Route::get('/users/create', [DashboardUserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/users', [DashboardUserController::class, 'store'])->name('dashboard.users.store');
    Route::get('/users/{user}/edit', [DashboardUserController::class, 'edit'])->name('dashboard.users.edit');
    Route::put('/users/{user}', [DashboardUserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/users/{user}', [DashboardUserController::class, 'destroy'])->name('dashboard.users.destroy');

    // Hardcoded Routes for missing endpoints
    Route::post('/staffs/reorder', function () {
        return response()->json(['success' => true]);
    });

    // Bulk Delete Routes
    $bulkDeletePaths = [
        'announcements',
        'announcements/categories',
        'activities',
        'staffs',
        'staffs/divisions',
        'products',
        'products/categories',
        'stats',
        'minutes',
        'activity-logs',
        'users',
        'home-sections',
        'settings'
    ];

    foreach ($bulkDeletePaths as $path) {
        Route::delete("/{$path}/bulk-delete", function () {
            return redirect()->back()->with('success', 'Data yang dipilih berhasil dihapus (Demo)');
        });
    }

    // Settings (index only — create/edit removed)
    Route::get('/settings', function () {
        return view('dashboard.settings.index', ['settings' => collect()]);
    })->name('dashboard.settings.index');

    Route::post('/settings', function () {
        return redirect('/dashboard/settings')->with('success', 'Setting berhasil ditambahkan (Demo)');
    })->name('dashboard.settings.store');

    Route::put('/settings/{setting}', function () {
        return redirect('/dashboard/settings')->with('success', 'Setting berhasil diupdate (Demo)');
    })->name('dashboard.settings.update');

    Route::delete('/settings/{setting}', function () {
        return redirect('/dashboard/settings')->with('success', 'Setting berhasil dihapus (Demo)');
    })->name('dashboard.settings.destroy');

});

Route::get('/dev/components', function () {
    return view('dev.components');
});

Route::prefix('/dev/mail')->group(function () {
    Route::get('/setup-password-form', function () {
        return view('mail.setup-password-form', ['token' => 'dummy-token']);
    });
    Route::get('/setup-password-success', function () {
        return view('mail.setup-password-success', ['email' => 'dummy@example.com']);
    });
    Route::get('/aspiration-feedback', function () {
        return view('mail.aspiration-feedback', [
            'aspiration' => (object) [
                'tracking_code' => 'KARTALA-12345',
                'subject' => 'Fasilitas Kampus',
                'status' => 'reviewed',
                'reply_message' => 'Terima kasih atas aspirasinya, sedang kami tindak lanjuti.'
            ]
        ]);
    });
});