<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\UploadedFile;

class CreateProductService
{
    public function execute(array $validated): Product
    {
        $validated['is_available'] = $validated['is_available'] ?? true;

        $product = Product::create($validated);

        if (! empty($validated['images'])) {
            $this->syncProductImages($product, $validated['images']);
        }

        return $product;
    }

    private function syncProductImages(Product $product, array $images): void
    {
        $existingImageIds  = $product->images()->pluck('id')->all();
        $submittedImageIds = [];

        foreach ($images as $imageData) {
            // Jika ada file lokal yang diupload, simpan dan gunakan sebagai image_path
            $imageFile = $imageData['image_file'] ?? null;
            if ($imageFile instanceof UploadedFile) {
                $imageData['image_path'] = $imageFile->store('products/images', 'public');
            }

            // Buang key image_file — bukan kolom DB
            unset($imageData['image_file']);

            // Lewati entri yang tidak memiliki path sama sekali
            if (empty($imageData['image_path'])) {
                continue;
            }

            $imageData['is_primary'] = isset($imageData['is_primary']) && (bool) $imageData['is_primary'];
            $imageData['order']      = isset($imageData['order']) ? (int) $imageData['order'] : 0;

            if (! empty($imageData['id']) && \in_array($imageData['id'], $existingImageIds, true)) {
                $submittedImageIds[] = $imageData['id'];
                $product->images()->where('id', $imageData['id'])->update([
                    'image_path' => $imageData['image_path'],
                    'order'      => $imageData['order'],
                    'is_primary' => $imageData['is_primary'],
                ]);
                continue;
            }

            $created             = $product->images()->create([
                'image_path' => $imageData['image_path'],
                'order'      => $imageData['order'],
                'is_primary' => $imageData['is_primary'],
            ]);
            $submittedImageIds[] = $created->id;
        }

        if (empty($submittedImageIds)) {
            $product->images()->delete();
            return;
        }

        $product->images()->whereNotIn('id', $submittedImageIds)->delete();
    }
}
