<?php

namespace App\Http\Controllers;

use App\Services\Activity\GetActivityBySlugService;
use App\Services\Activity\GetAllActivitiesService;
use App\Services\Announcement\GetAllAnnouncementsService;
use App\Services\Announcement\GetAnnouncementBySlugService;
use App\Services\Announcement\GetAnnouncementCategoriesService;
use App\Services\Aspiration\GetWeeklySpotlightService;
use App\Services\Home\GetActivitiesPreviewService;
use App\Services\Home\GetAnnouncementsPreviewService;
use App\Services\Home\GetHomeStatsService;
use App\Services\Home\GetHomeSectionsService;
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

    public function staffs(GetAllStaffsService $getStaffs, GetDivisionsService $getDivisions): View
    {
        return view('pages.staff', [
            'staffs'    => $getStaffs->execute(),
            'divisions' => $getDivisions->execute(excludeBph: true),
        ]);
    }

    public function staffDetail(string $id, GetStaffByIdService $getStaff): View
    {
        $staff = $getStaff->execute($id);

        return view('pages.staff-detail', compact('staff'));
    }

    public function divisionDetail(string $slug, GetDivisionBySlugService $getDivision): View
    {
        $division = $getDivision->execute($slug);

        return view('pages.division-detail', compact('division'));
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
            $request->query('status'),
            $request->query('search'),
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

    public function aspirations(GetWeeklySpotlightService $getSpotlight): View
    {
        return view('pages.aspirations', [
            'spotlight' => $getSpotlight->execute(),
        ]);
    }

    // -----------------------------------------------------------------------
    // Dev only
    // -----------------------------------------------------------------------

    public function devComponents(): View
    {
        return view('dev.components');
    }
}
