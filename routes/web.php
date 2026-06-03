<?php

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SetupPasswordController;
use App\Http\Controllers\DashboardActivityController;
use App\Http\Controllers\DashboardActivityLogController;
use App\Http\Controllers\DashboardAnnouncementController;
use App\Http\Controllers\DashboardAspirationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardDivisionController;
use App\Http\Controllers\DashboardHomeSectionController;
use App\Http\Controllers\DashboardPeriodController;
use App\Http\Controllers\DeveloperTeamController;
use App\Http\Controllers\DashboardMinuteController;
use App\Http\Controllers\DashboardProductCategoryController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardStaffController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\EditorUploadController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// =============================================================================
// Halaman Publik (Client)
// =============================================================================

Route::get('/',                     [PageController::class, 'home'])->name('home');
Route::get('/staff',                [PageController::class, 'staffs'])->name('staff');
Route::get('/staff/{id}',           [PageController::class, 'staffDetail'])->name('staff.show');
Route::get('/divisi/{slug}',        [PageController::class, 'divisionDetail'])->name('divisions.show');
Route::get('/activities',           [PageController::class, 'activities'])->name('activities');
Route::get('/activities/{slug}',    [PageController::class, 'activityDetail'])->name('activities.show');
Route::get('/store',                [PageController::class, 'store'])->name('store');
Route::get('/store/{slug}',         [PageController::class, 'productDetail'])->name('store.show');
Route::get('/announcements',        [PageController::class, 'announcements'])->name('announcements');
Route::get('/announcements/{slug}', [PageController::class, 'announcementDetail'])->name('announcements.show');
Route::get('/aspirations',          [PageController::class, 'aspirations'])->name('aspirations');
Route::get('/tim-pengembang',       [DeveloperTeamController::class, 'show'])->name('developer-team');

Route::post('/aspirations', [AspirationController::class, 'storeWeb'])
    ->middleware('throttle:aspirasi')
    ->name('aspirations.store');

// =============================================================================
// Autentikasi & Setup Password
// =============================================================================

Route::get('/setup-password/{token}', [SetupPasswordController::class, 'show'])->name('setup-password');
Route::post('/setup-password',        [SetupPasswordController::class, 'store'])->name('setup-password.store');
Route::get('/setup-password-success', [SetupPasswordController::class, 'success'])->name('setup-password.success');

Route::get('/login',   [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login',  [LoginController::class, 'loginWeb'])->middleware(['guest', 'throttle:5,1'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logoutWeb'])->middleware('auth')->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password',  [ForgotPasswordController::class, 'show'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])->name('password.reset');
    Route::post('/reset-password',        [ResetPasswordController::class, 'store'])->name('password.update');
});

// =============================================================================
// Dashboard (Auth Required)
// =============================================================================

Route::middleware(['auth', 'check.menu'])->prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Announcements
    Route::get('/announcements',                        [DashboardAnnouncementController::class, 'index'])->name('dashboard.announcements');
    Route::get('/announcements/create',                 [DashboardAnnouncementController::class, 'create'])->name('dashboard.announcements.create');
    Route::post('/announcements',                       [DashboardAnnouncementController::class, 'store'])->name('dashboard.announcements.store');
    Route::delete('/announcements/bulk-delete',         [DashboardAnnouncementController::class, 'bulkDestroy']);
    Route::delete('/announcements/categories/bulk-delete', [DashboardAnnouncementController::class, 'bulkDestroyCat']);
    Route::get('/announcements/{announcement}/edit',    [DashboardAnnouncementController::class, 'edit'])->name('dashboard.announcements.edit');
    Route::put('/announcements/{announcement}',         [DashboardAnnouncementController::class, 'update'])->name('dashboard.announcements.update');
    Route::delete('/announcements/{announcement}',      [DashboardAnnouncementController::class, 'destroy'])->name('dashboard.announcements.destroy');

    // Activities
    Route::get('/activities',                    [DashboardActivityController::class, 'index'])->name('dashboard.activities');
    Route::get('/activities/create',             [DashboardActivityController::class, 'create'])->name('dashboard.activities.create');
    Route::post('/activities',                   [DashboardActivityController::class, 'store'])->name('dashboard.activities.store');
    Route::delete('/activities/bulk-delete',     [DashboardActivityController::class, 'bulkDestroy']);
    Route::get('/activities/{activity}/edit',    [DashboardActivityController::class, 'edit'])->name('dashboard.activities.edit');
    Route::put('/activities/{activity}',         [DashboardActivityController::class, 'update'])->name('dashboard.activities.update');
    Route::delete('/activities/{activity}',      [DashboardActivityController::class, 'destroy'])->name('dashboard.activities.destroy');

    // Staffs
    Route::get('/staffs',                    [DashboardStaffController::class, 'index'])->name('dashboard.staffs');
    Route::get('/staffs/create',             [DashboardStaffController::class, 'create'])->name('dashboard.staffs.create');
    Route::post('/staffs',                   [DashboardStaffController::class, 'store'])->name('dashboard.staffs.store');
    Route::post('/staffs/reorder',           [DashboardStaffController::class, 'reorder']);
    Route::delete('/staffs/bulk-delete',     [DashboardStaffController::class, 'bulkDestroy']);
    Route::delete('/staffs/truncate',        [DashboardStaffController::class, 'truncate'])->name('dashboard.staffs.truncate');
    Route::get('/staffs/{staff}/edit',       [DashboardStaffController::class, 'edit'])->name('dashboard.staffs.edit');
    Route::put('/staffs/{staff}',            [DashboardStaffController::class, 'update'])->name('dashboard.staffs.update');
    Route::delete('/staffs/{staff}',         [DashboardStaffController::class, 'destroy'])->name('dashboard.staffs.destroy');

    // Periods (harus sebelum wildcard /staffs/{staff})
    Route::get('/staffs/periods',                     [DashboardPeriodController::class, 'index'])->name('dashboard.staffs.periods');
    Route::get('/staffs/periods/create',              [DashboardPeriodController::class, 'create'])->name('dashboard.staffs.periods.create');
    Route::post('/staffs/periods',                    [DashboardPeriodController::class, 'store'])->name('dashboard.staffs.periods.store');
    Route::delete('/staffs/periods/bulk-delete',      [DashboardPeriodController::class, 'bulkDestroy']);
    Route::get('/staffs/periods/{period}/edit',       [DashboardPeriodController::class, 'edit'])->name('dashboard.staffs.periods.edit');
    Route::put('/staffs/periods/{period}',            [DashboardPeriodController::class, 'update'])->name('dashboard.staffs.periods.update');
    Route::delete('/staffs/periods/{period}',         [DashboardPeriodController::class, 'destroy'])->name('dashboard.staffs.periods.destroy');

    // Divisions
    Route::get('/staffs/divisions',                       [DashboardDivisionController::class, 'index'])->name('dashboard.staffs.divisions');
    Route::get('/staffs/divisions/create',                [DashboardDivisionController::class, 'create'])->name('dashboard.staffs.divisions.create');
    Route::post('/staffs/divisions',                      [DashboardDivisionController::class, 'store'])->name('dashboard.staffs.divisions.store');
    Route::delete('/staffs/divisions/bulk-delete',        [DashboardDivisionController::class, 'bulkDestroy']);
    Route::get('/staffs/divisions/{division}/edit',       [DashboardDivisionController::class, 'edit'])->name('dashboard.staffs.divisions.edit');
    Route::put('/staffs/divisions/{division}',            [DashboardDivisionController::class, 'update'])->name('dashboard.staffs.divisions.update');
    Route::delete('/staffs/divisions/{division}',         [DashboardDivisionController::class, 'destroy'])->name('dashboard.staffs.divisions.destroy');

    // Products
    Route::get('/products',                  [DashboardProductController::class, 'index'])->name('dashboard.products');
    Route::get('/products/create',           [DashboardProductController::class, 'create'])->name('dashboard.products.create');
    Route::post('/products',                 [DashboardProductController::class, 'store'])->name('dashboard.products.store');
    Route::delete('/products/bulk-delete',   [DashboardProductController::class, 'bulkDestroy']);
    Route::patch('/products/bulk-phone',     [DashboardProductController::class, 'bulkUpdatePhone'])->name('dashboard.products.bulk-phone');
    Route::get('/products/{product}/edit',   [DashboardProductController::class, 'edit'])->name('dashboard.products.edit');
    Route::put('/products/{product}',        [DashboardProductController::class, 'update'])->name('dashboard.products.update');
    Route::delete('/products/{product}',     [DashboardProductController::class, 'destroy'])->name('dashboard.products.destroy');

    // Product Categories
    Route::get('/products/categories',                     [DashboardProductCategoryController::class, 'index'])->name('dashboard.products.categories');
    Route::get('/products/categories/create',              [DashboardProductCategoryController::class, 'create'])->name('dashboard.products.categories.create');
    Route::post('/products/categories',                    [DashboardProductCategoryController::class, 'store'])->name('dashboard.products.categories.store');
    Route::delete('/products/categories/bulk-delete',      [DashboardProductCategoryController::class, 'bulkDestroy']);
    Route::get('/products/categories/{category}/edit',     [DashboardProductCategoryController::class, 'edit'])->name('dashboard.products.categories.edit');
    Route::put('/products/categories/{category}',          [DashboardProductCategoryController::class, 'update'])->name('dashboard.products.categories.update');
    Route::delete('/products/categories/{category}',       [DashboardProductCategoryController::class, 'destroy'])->name('dashboard.products.categories.destroy');

    // Aspirations
    Route::get('/aspirations',                     [DashboardAspirationController::class, 'index'])->name('dashboard.aspirations');
    Route::get('/aspirations/{id}',                [DashboardAspirationController::class, 'show'])->name('dashboard.aspirations.show');
    Route::put('/aspirations/{id}/feedback',       [DashboardAspirationController::class, 'feedback'])->name('dashboard.aspirations.feedback');

    // Minutes (Notulensi) — show & print harus sebelum /{minute} wildcard
    Route::get('/minutes',               [DashboardMinuteController::class, 'index'])->name('dashboard.minutes');
    Route::get('/minutes/create',        [DashboardMinuteController::class, 'create'])->name('dashboard.minutes.create');
    Route::post('/minutes',              [DashboardMinuteController::class, 'store'])->name('dashboard.minutes.store');
    Route::delete('/minutes/bulk-delete', [DashboardMinuteController::class, 'bulkDestroy']);
    Route::get('/minutes/{minute}/edit', [DashboardMinuteController::class, 'edit'])->name('dashboard.minutes.edit');
    Route::put('/minutes/{minute}',      [DashboardMinuteController::class, 'update'])->name('dashboard.minutes.update');
    Route::delete('/minutes/{minute}',   [DashboardMinuteController::class, 'destroy'])->name('dashboard.minutes.destroy');
    Route::get('/minutes/{id}/print',    [DashboardMinuteController::class, 'print'])->name('dashboard.minutes.print');
    Route::get('/minutes/{id}',          [DashboardMinuteController::class, 'show'])->name('dashboard.minutes.show');

    // Home Sections
    Route::get('/home-sections',                    [DashboardHomeSectionController::class, 'index'])->name('dashboard.home-sections.index');
    Route::get('/home-sections/{section}/edit',     [DashboardHomeSectionController::class, 'edit'])->name('dashboard.home-sections.edit');
    Route::put('/home-sections/{section}',          [DashboardHomeSectionController::class, 'update'])->name('dashboard.home-sections.update');

    // Activity Logs
    Route::get('/activity-logs',           [DashboardActivityLogController::class, 'index'])->name('dashboard.activity-logs');
    Route::delete('/activity-logs/bulk-delete', [DashboardActivityLogController::class, 'bulkDestroy']);

    // Users
    Route::get('/users',                 [DashboardUserController::class, 'index'])->name('dashboard.users');
    Route::get('/users/create',          [DashboardUserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/users',                [DashboardUserController::class, 'store'])->name('dashboard.users.store');
    Route::delete('/users/bulk-delete',  [DashboardUserController::class, 'bulkDestroy']);
    Route::get('/users/{user}/edit',     [DashboardUserController::class, 'edit'])->name('dashboard.users.edit');
    Route::put('/users/{user}',          [DashboardUserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/users/{user}',       [DashboardUserController::class, 'destroy'])->name('dashboard.users.destroy');

    // Settings
    Route::get('/settings',              [DashboardSettingController::class, 'index'])->name('dashboard.settings.index');
    Route::post('/settings',             [DashboardSettingController::class, 'store'])->name('dashboard.settings.store');
    Route::delete('/settings/bulk-delete', [DashboardSettingController::class, 'bulkDestroy']);
    Route::put('/settings/{role}',       [DashboardSettingController::class, 'update'])->name('dashboard.settings.update');
    Route::patch('/settings/{role}/menu', [DashboardSettingController::class, 'updateMenuAccess'])->name('dashboard.settings.menu-access');
    Route::delete('/settings/{role}',    [DashboardSettingController::class, 'destroy'])->name('dashboard.settings.destroy');

    // Editor — upload gambar dari rich-text editor (Quill.js)
    Route::post('/editor/upload', [EditorUploadController::class, 'store'])
        ->middleware('throttle:30,1')
        ->name('dashboard.editor.upload');

    // Developer Teams (Tim Pengembang)
    Route::get('/developer-teams',                [DeveloperTeamController::class, 'index'])->name('dashboard.developer-teams');
    Route::put('/developer-teams',                [DeveloperTeamController::class, 'save'])->name('dashboard.developer-teams.save');
    Route::delete('/developer-teams/period',      [DeveloperTeamController::class, 'deletePeriod'])->name('dashboard.developer-teams.delete-period');

    // Profile
    Route::get('/profile',          [DashboardProfileController::class, 'index'])->name('dashboard.profile');
    Route::put('/profile',          [DashboardProfileController::class, 'update'])->name('dashboard.profile.update');
    Route::put('/profile/password', [DashboardProfileController::class, 'updatePassword'])->name('dashboard.profile.password');
});

// =============================================================================
// Dev (hanya untuk development)
// =============================================================================

if (app()->environment('local')) {
    Route::get('/dev/components', [PageController::class, 'devComponents']);
}
