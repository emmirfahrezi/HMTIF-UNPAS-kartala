<?php

namespace App\Services\Product;

use App\Models\Product;

class UpdateProductService
{
    public function execute(Product $product, array $validated): Product
    {
        $validated['is_available'] = $validated['is_available'] ?? false;

        $product->update($validated);

        if (isset($validated['images'])) {
            $this->syncProductImages($product, $validated['images']);
        }

        return $product;
    }

    private function syncProductImages(Product $product, array $images): void
    {
        $existingImageIds = $product->images()->pluck('id')->all();
        $submittedImageIds = [];

        foreach ($images as $imageData) {
            if (empty($imageData['image_path'])) {
                continue;
            }

            $imageData['is_primary'] = isset($imageData['is_primary']) && (bool) $imageData['is_primary'];
            $imageData['order'] = isset($imageData['order']) ? (int) $imageData['order'] : 0;

            if (! empty($imageData['id']) && in_array($imageData['id'], $existingImageIds, true)) {
                $submittedImageIds[] = $imageData['id'];
                $product->images()->where('id', $imageData['id'])->update([
                    'image_path' => $imageData['image_path'],
                    'order' => $imageData['order'],
                    'is_primary' => $imageData['is_primary'],
                ]);
                continue;
            }

            $created = $product->images()->create([
                'image_path' => $imageData['image_path'],
                'order' => $imageData['order'],
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
