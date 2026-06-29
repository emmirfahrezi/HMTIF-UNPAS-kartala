<?php

namespace App\Http\Controllers;

use App\Services\Activity\GetActivityBySlugService;
use App\Services\Activity\GetAllActivitiesService;
use App\Services\Announcement\GetAllAnnouncementsService;
use App\Services\Announcement\GetAnnouncementBySlugService;
use App\Services\Announcement\GetAnnouncementCategoriesService;
use App\Services\Home\GetActivitiesPreviewService;
use App\Services\Home\GetAnnouncementsPreviewService;
use App\Services\Home\GetHomeStatsService;
use App\Services\Home\GetHomeSectionsService;
use App\Models\Period;
use App\Services\Staff\GetAllStaffsService;
use App\Services\Staff\GetDivisionBySlugService;
use App\Services\Staff\GetDivisionsService;
use App\Services\Staff\GetStaffByIdService;
use App\Services\Store\GetAllProductsService;
use App\Services\Store\GetProductBySlugService;
use App\Services\Store\GetProductCategoriesService;
use App\Services\Store\GetRelatedProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    // -----------------------------------------------------------------------
    // Halaman Home
    // -----------------------------------------------------------------------

    public function home(
        GetHomeStatsService $getStats,
        GetActivitiesPreviewService $getActivitiesPreview,
        GetAnnouncementsPreviewService $getAnnouncementsPreview,
        GetHomeSectionsService $getHomeSections,
    ): View {
        return view('pages.home', [
            'stats'         => $getStats->execute(),
            'activities'    => $getActivitiesPreview->execute(),
            'announcements' => $getAnnouncementsPreview->execute(),
            'homeSections'  => $getHomeSections->execute(),
        ]);
    }

    // -----------------------------------------------------------------------
    // Halaman Staff / Pengurus
    // -----------------------------------------------------------------------

    public function staffs(
        Request $request,
        GetAllStaffsService $getStaffs,
        GetDivisionsService $getDivisions,
    ): View {
        $periods      = Period::orderBy('display_order')->get();
        $activePeriod = Period::resolveFromRequest($request, $periods);

        return view('pages.staff', [
            'staffs'       => $getStaffs->execute($activePeriod),
            'divisions'    => $getDivisions->execute(excludeBph: true, period: $activePeriod),
            'periods'      => $periods,
            'activePeriod' => $activePeriod,
        ]);
    }

    public function staffDetail(string $id, Request $request, GetStaffByIdService $getStaff): View
    {
        $periods      = Period::orderBy('display_order')->get();
        $activePeriod = Period::resolveFromRequest($request, $periods);
        $staff        = $getStaff->execute($id);

        return view('pages.staff-detail', compact('staff', 'periods', 'activePeriod'));
    }

    public function divisionDetail(string $slug, Request $request, GetDivisionBySlugService $getDivision): View
    {
        $periods      = Period::orderBy('display_order')->get();
        $activePeriod = Period::resolveFromRequest($request, $periods);
        $division     = $getDivision->execute($slug, $activePeriod);

        return view('pages.division-detail', compact('division', 'periods', 'activePeriod'));
    }

    // -----------------------------------------------------------------------
    // Halaman Kegiatan
    // -----------------------------------------------------------------------

    public function activities(
        Request $request,
        GetAllActivitiesService $getActivities,
        GetAllAnnouncementsService $getAnnouncements,
    ): View {
        $activities = $getActivities->execute(
            $request->query('status') ?: null,
            $request->query('search') ?: null,
            $request->query('sort', 'latest'),
        );

        return view('pages.activities', [
            'activities'         => $activities,
            'upcomingActivities' => $getActivities->execute('upcoming'),
            'announcements'      => $getAnnouncements->execute(),
        ]);
    }

    public function activityDetail(string $slug, GetActivityBySlugService $getActivity): View
    {
        $activity = $getActivity->execute($slug);

        return view('pages.activity-detail', compact('activity'));
    }

    // -----------------------------------------------------------------------
    // Halaman Toko
    // -----------------------------------------------------------------------

    public function store(
        Request $request,
        GetAllProductsService $getProducts,
        GetProductCategoriesService $getCategories,
    ): View {
        $products = $getProducts->execute(
            $request->query('category'),
            $request->query('search'),
            $request->query('sort', 'latest'),
        );

        return view('pages.store', [
            'products'   => $products,
            'categories' => $getCategories->execute(),
        ]);
    }

    public function productDetail(
        string $slug,
        GetProductBySlugService $getProduct,
        GetRelatedProductsService $getRelated,
    ): View {
        $product = $getProduct->execute($slug);

        return view('pages.product-detail', [
            'product' => $product,
            'related' => $getRelated->execute($product),
        ]);
    }

    // -----------------------------------------------------------------------
    // Halaman Pengumuman
    // -----------------------------------------------------------------------

    public function announcements(
        Request $request,
        GetAllAnnouncementsService $getAnnouncements,
        GetAnnouncementCategoriesService $getCategories,
    ): View {
        $announcements = $getAnnouncements->execute(
            $request->query('category_id') ?: null,
            $request->query('search'),
            $request->query('sort', 'latest'),
        );

        return view('pages.announcements', [
            'announcements' => $announcements,
            'categories'    => $getCategories->execute(),
        ]);
    }

    public function announcementDetail(string $slug, GetAnnouncementBySlugService $getAnnouncement): View
    {
        $announcement = $getAnnouncement->execute($slug);

        return view('pages.announcement-detail', compact('announcement'));
    }

    // -----------------------------------------------------------------------
    // Halaman Aspirasi
    // -----------------------------------------------------------------------

    public function aspirations(): View
    {
        $trackedAspiration = null;
        $code = strtoupper(trim((string) request('code', '')));

        if ($code !== '') {
            $trackedAspiration = \App\Models\Aspiration::where('tracking_code', $code)->first();
        }

        return view('pages.aspirations', compact('trackedAspiration'));
    }

    // -----------------------------------------------------------------------
    // Dev only
    // -----------------------------------------------------------------------

    public function devComponents(): View
    {
        return view('dev.components');
    }
}
