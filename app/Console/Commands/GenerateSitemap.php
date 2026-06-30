<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Division;
use App\Models\Product;
use App\Models\Staff;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml untuk halaman publik HMTIF-UNPAS';

    public function handle(): void
    {
        $sitemap = Sitemap::create()
            ->add(Url::create(url('/'))->setPriority(1.0)->setChangeFrequency('weekly'))
            ->add(Url::create(url('/staff'))->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create(url('/activities'))->setPriority(0.9)->setChangeFrequency('weekly'))
            ->add(Url::create(url('/store'))->setPriority(0.8)->setChangeFrequency('weekly'))
            ->add(Url::create(url('/announcements'))->setPriority(0.9)->setChangeFrequency('daily'))
            ->add(Url::create(url('/aspirations'))->setPriority(0.5)->setChangeFrequency('yearly'))
            ->add(Url::create(url('/developer-team'))->setPriority(0.4)->setChangeFrequency('yearly'));

        Activity::all()->each(function (Activity $activity) use ($sitemap) {
            $sitemap->add(
                Url::create(route('activities.show', $activity->slug))
                    ->setLastModificationDate($activity->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency('monthly')
            );
        });

        // Hanya pengumuman yang sudah dipublikasi (published_at <= sekarang)
        Announcement::where('published_at', '<=', now())->each(function (Announcement $announcement) use ($sitemap) {
            $sitemap->add(
                Url::create(route('announcements.show', $announcement->slug))
                    ->setLastModificationDate($announcement->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency('monthly')
            );
        });

        // Hanya produk yang tersedia
        Product::where('is_available', true)->each(function (Product $product) use ($sitemap) {
            $sitemap->add(
                Url::create(route('store.show', $product->slug))
                    ->setLastModificationDate($product->updated_at)
                    ->setPriority(0.6)
                    ->setChangeFrequency('monthly')
            );
        });

        Staff::where('is_active', true)->each(function (Staff $staff) use ($sitemap) {
            $sitemap->add(
                Url::create(route('staff.show', $staff->id))
                    ->setLastModificationDate($staff->updated_at)
                    ->setPriority(0.5)
                    ->setChangeFrequency('monthly')
            );
        });

        Division::all()->each(function (Division $division) use ($sitemap) {
            $sitemap->add(
                Url::create(route('divisions.show', $division->slug))
                    ->setLastModificationDate($division->updated_at)
                    ->setPriority(0.5)
                    ->setChangeFrequency('monthly')
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap berhasil di-generate: ' . public_path('sitemap.xml'));
    }
}
