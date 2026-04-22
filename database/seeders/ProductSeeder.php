<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $pakaian   = ProductCategory::where('slug', 'pakaian')->first();
        $aksesoris = ProductCategory::where('slug', 'aksesoris')->first();
        $alatTulis = ProductCategory::where('slug', 'alat-tulis')->first();
        $bundling  = ProductCategory::where('slug', 'bundling')->first();

        $products = [
            [
                'product_category_id' => $pakaian->id,
                'name'         => 'Hoodie Kabinet Kartala 2026',
                'slug'         => 'hoodie-kabinet-kartala-2026',
                'description'  => 'Hoodie eksklusif edisi terbatas Kabinet Kartala 2026. Material Cotton Fleece 330gsm premium dengan sablon Plastisol Digital High Definition. Desain minimalis namun tetap menonjolkan identitas Teknik Informatika UNPAS yang progresif.',
                'price'        => 185000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1578587018452-892bacef3f21?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                    ['url' => 'https://images.unsplash.com/photo-1556821840-3a9329b31f96?q=80&w=900&auto=format&fit=crop', 'is_primary' => false],
                ],
            ],
            [
                'product_category_id' => $pakaian->id,
                'name'         => 'T-Shirt Oversize HMTIF',
                'slug'         => 't-shirt-oversize-hmtif',
                'description'  => 'T-shirt oversize khas HMTIF UNPAS dengan bahan Cotton Combed 24s yang nyaman untuk aktivitas sehari-hari. Tersedia dalam pilihan warna Forest Green khas Kartala.',
                'price'        => 95000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $pakaian->id,
                'name'         => 'Polo Shirt Resmi HMTIF UNPAS',
                'slug'         => 'polo-shirt-resmi-hmtif-unpas',
                'description'  => 'Polo shirt resmi HMTIF UNPAS cocok untuk kegiatan formal dan semi-formal. Berbahan Lacoste PE Premium dengan bordir logo HMTIF di dada kiri.',
                'price'        => 135000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1586363104862-3a5e2ab60d99?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $pakaian->id,
                'name'         => 'Buckethat Special Edition Kartala',
                'slug'         => 'buckethat-special-edition-kartala',
                'description'  => 'Buckethat edisi spesial Kabinet Kartala dengan bahan American Drill premium. Desain simpel dan stylish untuk kegiatan outdoor maupun indoor.',
                'price'        => 65000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1556306535-0f09a537f0a3?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $pakaian->id,
                'name'         => 'Totebag Canvas Informatika',
                'slug'         => 'totebag-canvas-informatika',
                'description'  => 'Totebag berbahan Canvas Drill Grey yang stylish dan fungsional. Sablon logo HMTIF UNPAS dengan tinta waterbase berkualitas tinggi. Cocok untuk ke kampus setiap hari.',
                'price'        => 45000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $aksesoris->id,
                'name'         => 'Lanyard & ID Card Holder Premium',
                'slug'         => 'lanyard-id-card-holder-premium',
                'description'  => 'Lanyard dan ID Card Holder berbahan Polyester High Quality dengan pengait metal tahan karat. Desain eksklusif HMTIF UNPAS Kabinet Kartala.',
                'price'        => 35000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $aksesoris->id,
                'name'         => 'Sticker Pack Kartala (5 pcs)',
                'slug'         => 'sticker-pack-kartala-5-pcs',
                'description'  => 'Paket 5 sticker eksklusif desain Kabinet Kartala berbahan Vinyl Matte tahan air. Cocok untuk laptop, botol minum, atau dekorasi.',
                'price'        => 15000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1572375927902-1c09e4d5d5cc?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $aksesoris->id,
                'name'         => 'Pin Badge HMTIF UNPAS',
                'slug'         => 'pin-badge-hmtif-unpas',
                'description'  => 'Pin badge eksklusif HMTIF UNPAS diameter 5.8cm dengan finishing glossy. Cocok dipasang di tas, jaket, atau seragam.',
                'price'        => 10000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $aksesoris->id,
                'name'         => 'Masker Kain HMTIF 3-Layer',
                'slug'         => 'masker-kain-hmtif-3-layer',
                'description'  => 'Masker kain 3 lapis desain HMTIF UNPAS. Bahan katun premium yang nyaman dipakai seharian dengan lapisan filter tengah yang bisa diganti.',
                'price'        => 20000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1598963779765-f5dd264c4f73?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $alatTulis->id,
                'name'         => 'Notebook Kartala A5 Hard Cover',
                'slug'         => 'notebook-kartala-a5-hard-cover',
                'description'  => 'Notebook eksklusif Kabinet Kartala format A5 dengan cover hard emboss logo HMTIF. Isi 120 halaman dotted kertas ivory 80gsm anti-bleed. Ideal untuk mencatat kuliah.',
                'price'        => 40000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1517842645767-c639042777db?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $bundling->id,
                'name'         => 'Starter Pack HMTIF (Hoodie + Totebag + Sticker)',
                'slug'         => 'starter-pack-hmtif-hoodie-totebag-sticker',
                'description'  => 'Paket lengkap untuk mahasiswa baru HMTIF UNPAS! Bundling hemat berisi Hoodie Kartala, Totebag Canvas, dan Sticker Pack. Hemat Rp 20.000 dibanding beli satuan.',
                'price'        => 225000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
            [
                'product_category_id' => $bundling->id,
                'name'         => 'Official Kit HMTIF (Polo + Notebook + Pin)',
                'slug'         => 'official-kit-hmtif-polo-notebook-pin',
                'description'  => 'Paket resmi HMTIF UNPAS untuk pengurus dan delegasi. Berisi Polo Shirt Resmi, Notebook Kartala A5, dan Pin Badge HMTIF. Penampilan profesional untuk setiap acara.',
                'price'        => 175000,
                'is_available' => true,
                'images'       => [
                    ['url' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=900&auto=format&fit=crop', 'is_primary' => true],
                ],
            ],
        ];

        foreach ($products as $data) {
            $images = $data['images'];
            unset($data['images']);

            $product = Product::updateOrCreate(['slug' => $data['slug']], $data);

            // Buat images jika belum ada
            if ($product->images()->count() === 0) {
                foreach ($images as $order => $img) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $img['url'],
                        'is_primary'  => $img['is_primary'],
                        'order'       => $order + 1,
                    ]);
                }
            }
        }
    }
}
