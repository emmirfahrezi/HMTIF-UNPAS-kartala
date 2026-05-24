<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        $existingImages    = $product->images()->get()->keyBy('id');
        $submittedImageIds = [];

        foreach ($images as $imageData) {
            // Jika ada file lokal yang diupload, simpan dan gunakan sebagai image_path
            $imageFile = $imageData['image_file'] ?? null;
            if ($imageFile instanceof UploadedFile) {
                // Hapus file lama jika gambar sudah ada dan bukan URL eksternal
                if (! empty($imageData['id']) && $existingImages->has($imageData['id'])) {
                    $this->deleteLocalFile($existingImages->get($imageData['id'])->image_path);
                }
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

            if (! empty($imageData['id']) && $existingImages->has($imageData['id'])) {
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
            // Hapus semua file lokal sebelum delete record
            foreach ($existingImages as $img) {
                $this->deleteLocalFile($img->image_path);
            }
            $product->images()->delete();
            return;
        }

        // Hapus file lokal untuk gambar yang dihapus dari form
        $removedImages = $existingImages->whereNotIn('id', $submittedImageIds);
        foreach ($removedImages as $img) {
            $this->deleteLocalFile($img->image_path);
        }
        $product->images()->whereNotIn('id', $submittedImageIds)->delete();
    }

    /**
     * Hapus file dari storage lokal.
     * Tidak menghapus jika path adalah URL eksternal.
     */
    private function deleteLocalFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
