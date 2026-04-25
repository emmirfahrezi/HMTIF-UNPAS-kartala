<?php

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function (
    GetHomeStatsService $getStats,
    GetActivitiesPreviewService $getActivities,
    GetAnnouncementsPreviewService $getAnnouncements,
) {
    return view('pages.home', [
        'stats' => $getStats->execute(),
        'activities' => $getActivities->execute(),
        'announcements' => $getAnnouncements->execute(),
    ]);
})->name('home');

Route::get('/staff', function (
    GetAllStaffsService $getStaffs,
    GetDivisionsService $getDivisions,
) {
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

Route::get('/activities', function (
    Request $request,
    GetAllActivitiesService $getActivities,
    GetAllAnnouncementsService $getAnnouncements,
) {
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

Route::get('/store/{slug}', function (
    string $slug,
    GetProductBySlugService $getProduct,
    GetRelatedProductsService $getRelated,
) {
    $product = $getProduct->execute($slug);

    return view('pages.product-detail', [
        'product' => $product,
        'related' => $getRelated->execute($product),
    ]);
})->name('store.show');

Route::get('/announcements', function (
    Request $request,
    GetAllAnnouncementsService $getAnnouncements,
    GetAnnouncementCategoriesService $getCategories,
) {
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

Route::middleware('guest')->group(function () {
    Route::view('/login', 'pages.login')->name('login');
    Route::post('/login', [LoginController::class, 'loginWeb'])->name('login.store');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/announcements', [DashboardController::class, 'announcements'])->name('dashboard.announcements');
    Route::get('/announcements/create', [DashboardController::class, 'createAnnouncement'])->name('dashboard.announcements.create');
    Route::post('/announcements', [DashboardController::class, 'storeAnnouncement'])->name('dashboard.announcements.store');
    Route::get('/announcements/{announcement}/edit', [DashboardController::class, 'editAnnouncement'])->name('dashboard.announcements.edit');
    Route::put('/announcements/{announcement}', [DashboardController::class, 'updateAnnouncement'])->name('dashboard.announcements.update');
    Route::delete('/announcements/{announcement}', [DashboardController::class, 'destroyAnnouncement'])->name('dashboard.announcements.destroy');

    Route::get('/activities', [DashboardController::class, 'activities'])->name('dashboard.activities');
    Route::get('/activities/create', [DashboardController::class, 'createActivity'])->name('dashboard.activities.create');
    Route::post('/activities', [DashboardController::class, 'storeActivity'])->name('dashboard.activities.store');
    Route::get('/activities/{activity}/edit', [DashboardController::class, 'editActivity'])->name('dashboard.activities.edit');
    Route::put('/activities/{activity}', [DashboardController::class, 'updateActivity'])->name('dashboard.activities.update');
    Route::delete('/activities/{activity}', [DashboardController::class, 'destroyActivity'])->name('dashboard.activities.destroy');

    Route::get('/staffs', [DashboardController::class, 'staffs'])->name('dashboard.staffs');
    Route::get('/staffs/create', [DashboardController::class, 'createStaff'])->name('dashboard.staffs.create');
    Route::post('/staffs', [DashboardController::class, 'storeStaff'])->name('dashboard.staffs.store');
    Route::get('/staffs/{staff}/edit', [DashboardController::class, 'editStaff'])->name('dashboard.staffs.edit');
    Route::put('/staffs/{staff}', [DashboardController::class, 'updateStaff'])->name('dashboard.staffs.update');
    Route::delete('/staffs/{staff}', [DashboardController::class, 'destroyStaff'])->name('dashboard.staffs.destroy');

    Route::get('/staffs/divisions', [DashboardController::class, 'divisions'])->name('dashboard.staffs.divisions');
    Route::post('/staffs/divisions', [DashboardController::class, 'storeDivision'])->name('dashboard.staffs.divisions.store');
    Route::get('/staffs/divisions/{division}/edit', [DashboardController::class, 'editDivision'])->name('dashboard.staffs.divisions.edit');
    Route::put('/staffs/divisions/{division}', [DashboardController::class, 'updateDivision'])->name('dashboard.staffs.divisions.update');
    Route::delete('/staffs/divisions/{division}', [DashboardController::class, 'destroyDivision'])->name('dashboard.staffs.divisions.destroy');

    Route::get('/products', [DashboardController::class, 'products'])->name('dashboard.products');
    Route::get('/products/create', [DashboardController::class, 'createProduct'])->name('dashboard.products.create');
    Route::post('/products', [DashboardController::class, 'storeProduct'])->name('dashboard.products.store');
    Route::get('/products/{product}/edit', [DashboardController::class, 'editProduct'])->name('dashboard.products.edit');
    Route::put('/products/{product}', [DashboardController::class, 'updateProduct'])->name('dashboard.products.update');
    Route::delete('/products/{product}', [DashboardController::class, 'destroyProduct'])->name('dashboard.products.destroy');

    Route::get('/products/categories', [DashboardController::class, 'productCategories'])->name('dashboard.products.categories');
    Route::get('/products/categories/create', [DashboardController::class, 'createProductCategory'])->name('dashboard.products.categories.create');
    Route::post('/products/categories', [DashboardController::class, 'storeProductCategory'])->name('dashboard.products.categories.store');
    Route::get('/products/categories/{category}/edit', [DashboardController::class, 'editProductCategory'])->name('dashboard.products.categories.edit');
    Route::put('/products/categories/{category}', [DashboardController::class, 'updateProductCategory'])->name('dashboard.products.categories.update');
    Route::delete('/products/categories/{category}', [DashboardController::class, 'destroyProductCategory'])->name('dashboard.products.categories.destroy');

    Route::get('/aspirations', [DashboardController::class, 'aspirations'])->name('dashboard.aspirations');

    Route::get('/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
    Route::get('/stats/create', [DashboardController::class, 'createStat'])->name('dashboard.stats.create');
    Route::post('/stats', [DashboardController::class, 'storeStat'])->name('dashboard.stats.store');
    Route::get('/stats/{stat}/edit', [DashboardController::class, 'editStat'])->name('dashboard.stats.edit');
    Route::put('/stats/{stat}', [DashboardController::class, 'updateStat'])->name('dashboard.stats.update');
    Route::delete('/stats/{stat}', [DashboardController::class, 'destroyStat'])->name('dashboard.stats.destroy');

    Route::get('/minutes', [DashboardController::class, 'minutes'])->name('dashboard.minutes');
    Route::get('/minutes/create', [DashboardController::class, 'createMinute'])->name('dashboard.minutes.create');
    Route::post('/minutes', [DashboardController::class, 'storeMinute'])->name('dashboard.minutes.store');
    Route::get('/minutes/{minute}/edit', [DashboardController::class, 'editMinute'])->name('dashboard.minutes.edit');
    Route::put('/minutes/{minute}', [DashboardController::class, 'updateMinute'])->name('dashboard.minutes.update');
    Route::delete('/minutes/{minute}', [DashboardController::class, 'destroyMinute'])->name('dashboard.minutes.destroy');

    Route::get('/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::get('/settings/create', [DashboardController::class, 'createSetting'])->name('dashboard.settings.create');
    Route::post('/settings', [DashboardController::class, 'storeSetting'])->name('dashboard.settings.store');
    Route::get('/settings/{setting}/edit', [DashboardController::class, 'editSetting'])->name('dashboard.settings.edit');
    Route::put('/settings/{setting}', [DashboardController::class, 'updateSetting'])->name('dashboard.settings.update');
    Route::delete('/settings/{setting}', [DashboardController::class, 'destroySetting'])->name('dashboard.settings.destroy');

    Route::get('/users', [DashboardController::class, 'users'])->name('dashboard.users');
    Route::get('/users/create', [DashboardController::class, 'createUser'])->name('dashboard.users.create');
    Route::post('/users', [DashboardController::class, 'storeUser'])->name('dashboard.users.store');
    Route::get('/users/{user}/edit', [DashboardController::class, 'editUser'])->name('dashboard.users.edit');
    Route::put('/users/{user}', [DashboardController::class, 'updateUser'])->name('dashboard.users.update');
    Route::delete('/users/{user}', [DashboardController::class, 'destroyUser'])->name('dashboard.users.destroy');
});

Route::get('/dev/components', function () {
    return view('dev.components');
});