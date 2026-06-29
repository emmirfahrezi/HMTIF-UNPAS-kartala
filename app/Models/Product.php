<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'prd';

    protected $fillable = [
        'product_category_id', 'name', 'slug',
        'description', 'price', 'phone_number', 'order_text', 'is_available',
    ];

    /** Ukuran yang tersedia untuk produk berupa pakaian. */
    public const CLOTHING_SIZES = ['S', 'M', 'L', 'XL', 'XXL'];

    public function getPrimaryImageUrlAttribute(): string
    {
        return \media_url(
            optional($this->primaryImage)->image_path,
            'images/placeholders/product.svg'
        );
    }

    /** Slug kategori yang dianggap sebagai produk pakaian (perlu pilihan ukuran). */
    public const CLOTHING_CATEGORY_SLUGS = ['pakaian'];

    protected $casts = [
        'price'        => 'decimal:2',
        'is_available' => 'boolean',
    ];

    // -----------------------------------------------------------------------
    // Accessors
    // -----------------------------------------------------------------------

    /**
     * Nomor telepon yang sudah diformat ke format internasional (62xxx).
     * Digunakan untuk membangun URL WhatsApp order.
     */
    public function getFormattedPhoneAttribute(): string
    {
        $phone = preg_replace('/\D+/', '', (string) ($this->phone_number ?? ''));

        if ($phone === '') {
            return '';
        }

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }

    /**
     * Apakah produk ini memerlukan pilihan ukuran.
     * Ditentukan berdasarkan kategori produk — tidak ada slug hardcode.
     */
    public function getShowSizesAttribute(): bool
    {
        $categorySlug = $this->category?->slug ?? '';

        return in_array($categorySlug, self::CLOTHING_CATEGORY_SLUGS, true);
    }

    /**
     * Daftar ukuran yang tersedia.
     * Kosong jika produk bukan pakaian.
     *
     * @return string[]
     */
    public function getAvailableSizesAttribute(): array
    {
        return $this->showSizes ? self::CLOTHING_SIZES : [];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }
}