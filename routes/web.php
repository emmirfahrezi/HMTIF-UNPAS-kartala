<?php

use App\Http\Controllers\AspirationController;
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
use Illuminate\Support\Facades\Route;

Route::get('/', function (
    GetHomeStatsService $getStats,
    GetActivitiesPreviewService $getActivities,
    GetAnnouncementsPreviewService $getAnnouncements,
) {
    return view('pages.home', [
        'stats'         => $getStats->execute(),
        'activities'    => $getActivities->execute(),
        'announcements' => $getAnnouncements->execute(),
    ]);
})->name('home');

Route::get('/staff', function (
    GetAllStaffsService $getStaffs,
    GetDivisionsService $getDivisions,
) {
    return view('pages.staff', [
        'staffs'    => $getStaffs->execute(),
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
        'activities'         => $activities,
        'upcomingActivities' => (new GetAllActivitiesService)->execute('upcoming'),
        'announcements'      => $getAnnouncements->execute(),
    ]);
})->name('activities');

Route::get('/activities/{slug}', function (string $slug, GetActivityBySlugService $getActivity) {
    $activity = $getActivity->execute($slug);

    return view('pages.activity-detail', compact('activity'));
})->name('activities.show');

Route::get('/store', function (Request $request, GetAllProductsService $getProducts, GetProductCategoriesService $getCategories) {
    $products = $getProducts->execute($request->query('category'));

    return view('pages.store', [
        'products'   => $products,
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
        'product'  => $product,
        'related'  => $getRelated->execute($product),
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
        'categories'    => $getCategories->execute(),
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

Route::post('/aspirations', [AspirationController::class, 'storeWeb'])->name('aspirations.store');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

// Dev/Styleguide
Route::get('/dev/components', function () {
    return view('dev.components');
});
