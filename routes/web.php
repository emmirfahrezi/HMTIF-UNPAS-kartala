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
use App\Http\Controllers\DashboardSettingController;
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
        'staffs'    => $getStaffs->execute(),
        'divisions' => $getDivisions->execute(excludeBph: true),
    ]);
})->name('staff');

Route::get('/staff/{id}', function (string $id, GetStaffByIdService $getStaff) {
    $staff = $getStaff->execute($id);

    return view('pages.staff-detail', compact('staff'));
})->name('staff.show');

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

Route::post('/setup-password', function (Request $request) {
    $request->validate([
        'token'                 => 'required|string',
        'email'                 => 'required|email',
        'password'              => 'required|string|min:8|confirmed',
        'password_confirmation' => 'required|string',
    ]);

    $record = \DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->first();

    if (! $record || ! \Hash::check($request->token, $record->token)) {
        return back()->withErrors(['token' => 'Tautan tidak valid atau sudah kadaluarsa.']);
    }

    $user = \App\Models\User::where('email', $request->email)->first();
    if (! $user) {
        return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
    }

    $user->update(['password' => \Hash::make($request->password)]);

    \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    return redirect()->route('setup-password.success', ['email' => $request->email]);
})->name('setup-password.store');

Route::get('/setup-password-success', function () {
    return view('mail.setup-password-success', ['email' => request('email')]);
})->name('setup-password.success');


Route::get('/login', function () {
    return view('pages.login');
})->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'loginWeb'])
    ->middleware('guest')
    ->name('login.store');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Announcements — explicit routes before wildcard
    Route::get('/announcements', [DashboardAnnouncementController::class, 'index'])->name('dashboard.announcements');
    Route::get('/announcements/create', [DashboardAnnouncementController::class, 'create'])->name('dashboard.announcements.create');
    Route::post('/announcements', [DashboardAnnouncementController::class, 'store'])->name('dashboard.announcements.store');
    Route::delete('/announcements/bulk-delete', [DashboardAnnouncementController::class, 'bulkDestroy']);
    Route::delete('/announcements/categories/bulk-delete', [DashboardAnnouncementController::class, 'bulkDestroyCat']);
    Route::get('/announcements/{announcement}/edit', [DashboardAnnouncementController::class, 'edit'])->name('dashboard.announcements.edit');
    Route::put('/announcements/{announcement}', [DashboardAnnouncementController::class, 'update'])->name('dashboard.announcements.update');
    Route::delete('/announcements/{announcement}', [DashboardAnnouncementController::class, 'destroy'])->name('dashboard.announcements.destroy');

    // Activities — explicit routes before wildcard
    Route::get('/activities', [DashboardActivityController::class, 'index'])->name('dashboard.activities');
    Route::get('/activities/create', [DashboardActivityController::class, 'create'])->name('dashboard.activities.create');
    Route::post('/activities', [DashboardActivityController::class, 'store'])->name('dashboard.activities.store');
    Route::delete('/activities/bulk-delete', [DashboardActivityController::class, 'bulkDestroy']);
    Route::get('/activities/{activity}/edit', [DashboardActivityController::class, 'edit'])->name('dashboard.activities.edit');
    Route::put('/activities/{activity}', [DashboardActivityController::class, 'update'])->name('dashboard.activities.update');
    Route::delete('/activities/{activity}', [DashboardActivityController::class, 'destroy'])->name('dashboard.activities.destroy');

    // Staffs — explicit routes before wildcard
    Route::get('/staffs', [DashboardStaffController::class, 'index'])->name('dashboard.staffs');
    Route::get('/staffs/create', [DashboardStaffController::class, 'create'])->name('dashboard.staffs.create');
    Route::post('/staffs', [DashboardStaffController::class, 'store'])->name('dashboard.staffs.store');
    Route::post('/staffs/reorder', [DashboardStaffController::class, 'reorder']);
    Route::delete('/staffs/bulk-delete', [DashboardStaffController::class, 'bulkDestroy']);
    Route::get('/staffs/{staff}/edit', [DashboardStaffController::class, 'edit'])->name('dashboard.staffs.edit');
    Route::put('/staffs/{staff}', [DashboardStaffController::class, 'update'])->name('dashboard.staffs.update');
    Route::delete('/staffs/{staff}', [DashboardStaffController::class, 'destroy'])->name('dashboard.staffs.destroy');

    // Divisions — explicit routes before wildcard
    Route::get('/staffs/divisions', [DashboardDivisionController::class, 'index'])->name('dashboard.staffs.divisions');
    Route::get('/staffs/divisions/create', [DashboardDivisionController::class, 'create'])->name('dashboard.staffs.divisions.create');
    Route::post('/staffs/divisions', [DashboardDivisionController::class, 'store'])->name('dashboard.staffs.divisions.store');
    Route::delete('/staffs/divisions/bulk-delete', [DashboardDivisionController::class, 'bulkDestroy']);
    Route::get('/staffs/divisions/{division}/edit', [DashboardDivisionController::class, 'edit'])->name('dashboard.staffs.divisions.edit');
    Route::put('/staffs/divisions/{division}', [DashboardDivisionController::class, 'update'])->name('dashboard.staffs.divisions.update');
    Route::delete('/staffs/divisions/{division}', [DashboardDivisionController::class, 'destroy'])->name('dashboard.staffs.divisions.destroy');

    // Products — explicit routes before wildcard
    Route::get('/products', [DashboardProductController::class, 'index'])->name('dashboard.products');
    Route::get('/products/create', [DashboardProductController::class, 'create'])->name('dashboard.products.create');
    Route::post('/products', [DashboardProductController::class, 'store'])->name('dashboard.products.store');
    Route::delete('/products/bulk-delete', [DashboardProductController::class, 'bulkDestroy']);
    Route::get('/products/{product}/edit', [DashboardProductController::class, 'edit'])->name('dashboard.products.edit');
    Route::put('/products/{product}', [DashboardProductController::class, 'update'])->name('dashboard.products.update');
    Route::delete('/products/{product}', [DashboardProductController::class, 'destroy'])->name('dashboard.products.destroy');

    // Product Categories — explicit routes before wildcard
    Route::get('/products/categories', [DashboardProductCategoryController::class, 'index'])->name('dashboard.products.categories');
    Route::get('/products/categories/create', [DashboardProductCategoryController::class, 'create'])->name('dashboard.products.categories.create');
    Route::post('/products/categories', [DashboardProductCategoryController::class, 'store'])->name('dashboard.products.categories.store');
    Route::delete('/products/categories/bulk-delete', [DashboardProductCategoryController::class, 'bulkDestroy']);
    Route::get('/products/categories/{category}/edit', [DashboardProductCategoryController::class, 'edit'])->name('dashboard.products.categories.edit');
    Route::put('/products/categories/{category}', [DashboardProductCategoryController::class, 'update'])->name('dashboard.products.categories.update');
    Route::delete('/products/categories/{category}', [DashboardProductCategoryController::class, 'destroy'])->name('dashboard.products.categories.destroy');

    // Aspirations
    Route::get('/aspirations', [DashboardAspirationController::class, 'index'])->name('dashboard.aspirations');

    Route::get('/aspirations/{id}', function (string $id) {
        $aspiration = \App\Models\Aspiration::findOrFail($id);

        // Overlay feedback dari file JSON sampai kolom DB tersedia
        $feedbackFile = storage_path('app/aspiration_feedback.json');
        if (file_exists($feedbackFile)) {
            $feedbackData = json_decode(file_get_contents($feedbackFile), true) ?: [];
            if (isset($feedbackData[$id])) {
                $aspiration->status         = $feedbackData[$id]['status'];
                $aspiration->admin_feedback = $feedbackData[$id]['feedback'];
                $aspiration->feedback_sent_at = $feedbackData[$id]['sent_at'];
            }
        }

        return view('dashboard.aspirations.show', compact('aspiration'));
    })->name('dashboard.aspirations.show');

    Route::put('/aspirations/{id}/feedback', function (string $id, Request $request, \App\Services\Mail\MailService $mailService) {
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved,rejected',
            'feedback' => 'required|string|min:5',
        ]);

        $aspiration = \App\Models\Aspiration::find($id);
        if ($aspiration) {
            $aspiration->update([
                'status' => $request->status,
            ]);

            // Kirim email tanggapan otomatis jika email diisi
            if (!empty($aspiration->email)) {
                try {
                    $mailService->sendAspirationStatusUpdate(
                        $aspiration->email,
                        $aspiration->name ?: 'Pelapor',
                        $aspiration->subject,
                        $request->status,
                        $aspiration->tracking_code,
                        $request->feedback
                    );
                } catch (\Throwable $e) {
                    \Log::error('Gagal mengirim email feedback aspirasi: ' . $e->getMessage());
                }
            }
        }

        $feedbackFile = storage_path('app/aspiration_feedback.json');
        $feedbackData = [];
        if (file_exists($feedbackFile)) {
            $feedbackData = json_decode(file_get_contents($feedbackFile), true) ?: [];
        }
        $feedbackData[$id] = [
            'status'   => $request->status,
            'feedback' => $request->feedback,
            'sent_at'  => now()->format('Y-m-d H:i:s'),
        ];
        file_put_contents($feedbackFile, json_encode($feedbackData));

        return redirect()->route('dashboard.aspirations.show', $id)
            ->with('success', 'Feedback berhasil dikirim dan status aspirasi diperbarui!');
    })->name('dashboard.aspirations.feedback');

    // Stats — explicit routes before wildcard
    Route::get('/stats', [DashboardStatController::class, 'index'])->name('dashboard.stats');
    Route::get('/stats/create', [DashboardStatController::class, 'create'])->name('dashboard.stats.create');
    Route::post('/stats', [DashboardStatController::class, 'store'])->name('dashboard.stats.store');
    Route::delete('/stats/bulk-delete', [DashboardStatController::class, 'bulkDestroy']);
    Route::get('/stats/{stat}/edit', [DashboardStatController::class, 'edit'])->name('dashboard.stats.edit');
    Route::put('/stats/{stat}', [DashboardStatController::class, 'update'])->name('dashboard.stats.update');
    Route::delete('/stats/{stat}', [DashboardStatController::class, 'destroy'])->name('dashboard.stats.destroy');

    // Minutes — explicit routes before wildcard
    Route::get('/minutes', [DashboardMinuteController::class, 'index'])->name('dashboard.minutes');
    Route::get('/minutes/create', [DashboardMinuteController::class, 'create'])->name('dashboard.minutes.create');
    Route::post('/minutes', [DashboardMinuteController::class, 'store'])->name('dashboard.minutes.store');
    Route::delete('/minutes/bulk-delete', [DashboardMinuteController::class, 'bulkDestroy']);
    Route::get('/minutes/{minute}/edit', [DashboardMinuteController::class, 'edit'])->name('dashboard.minutes.edit');
    Route::put('/minutes/{minute}', [DashboardMinuteController::class, 'update'])->name('dashboard.minutes.update');
    Route::delete('/minutes/{minute}', [DashboardMinuteController::class, 'destroy'])->name('dashboard.minutes.destroy');
    Route::get('/minutes/{id}', function ($id) {
        $minute = \App\Models\Minute::with('attendees')->findOrFail($id);
        return view('dashboard.minutes.show', compact('minute'));
    })->name('dashboard.minutes.show');
    Route::get('/minutes/{id}/print', function ($id) {
        $minute = \App\Models\Minute::with('attendees')->findOrFail($id);
        return view('dashboard.minutes.print', compact('minute'));
    })->name('dashboard.minutes.print');

    // Home Sections
    Route::get('/home-sections', [DashboardHomeSectionController::class, 'index'])->name('dashboard.home-sections.index');
    Route::get('/home-sections/{section}/edit', [DashboardHomeSectionController::class, 'edit'])->name('dashboard.home-sections.edit');
    Route::put('/home-sections/{section}', [DashboardHomeSectionController::class, 'update'])->name('dashboard.home-sections.update');

    // Activity Logs
    Route::get('/activity-logs', [DashboardActivityLogController::class, 'index'])->name('dashboard.activity-logs');
    Route::delete('/activity-logs/bulk-delete', [DashboardActivityLogController::class, 'bulkDestroy']);

    // Users — explicit routes before wildcard
    Route::get('/users', [DashboardUserController::class, 'index'])->name('dashboard.users');
    Route::get('/users/create', [DashboardUserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/users', [DashboardUserController::class, 'store'])->name('dashboard.users.store');
    Route::delete('/users/bulk-delete', [DashboardUserController::class, 'bulkDestroy']);
    Route::get('/users/{user}/edit', [DashboardUserController::class, 'edit'])->name('dashboard.users.edit');
    Route::put('/users/{user}', [DashboardUserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/users/{user}', [DashboardUserController::class, 'destroy'])->name('dashboard.users.destroy');

    // Settings — explicit routes before wildcard
    Route::get('/settings', [DashboardSettingController::class, 'index'])->name('dashboard.settings.index');
    Route::post('/settings', [DashboardSettingController::class, 'store'])->name('dashboard.settings.store');
    Route::delete('/settings/bulk-delete', [DashboardSettingController::class, 'bulkDestroy']);
    Route::put('/settings/{role}', [DashboardSettingController::class, 'update'])->name('dashboard.settings.update');
    Route::patch('/settings/{role}/menu', [DashboardSettingController::class, 'updateMenuAccess'])->name('dashboard.settings.menu-access');
    Route::delete('/settings/{role}', [DashboardSettingController::class, 'destroy'])->name('dashboard.settings.destroy');

    // Profile
    Route::get('/profile', function () {
        return view('dashboard.profile.index');
    })->name('dashboard.profile');

    Route::put('/profile', function (Request $request) {
        $validated = $request->validate([
            'email'     => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'bio'       => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:255',
            'linkedin'  => 'nullable|string|max:1024',
            'photo'     => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $user->update(['email' => $validated['email']]);

        $staff = $user->staff ?? \App\Models\Staff::where('user_id', $user->id)->first();

        if ($staff) {
            $staffData = [
                'bio'       => $validated['bio'] ?? $staff->bio,
                'instagram' => $validated['instagram'] ?? $staff->instagram,
                'linkedin'  => $validated['linkedin'] ?? $staff->linkedin,
            ];

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('staffs/photos', 'public');
                $staffData['photo'] = $path;
            }

            $staff->update($staffData);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    })->name('dashboard.profile.update');

    Route::put('/profile/password', function (Request $request) {
        $request->validate([
            'old_password'          => 'required|string',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        $user = auth()->user();

        if (! \Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->update(['password' => \Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    })->name('dashboard.profile.password');

});

Route::get('/dev/components', function () {
    return view('dev.components');
});
