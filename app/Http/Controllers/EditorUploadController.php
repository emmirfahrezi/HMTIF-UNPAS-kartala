<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorUploadController extends Controller
{
    /**
     * Terima file gambar dari editor (Quill.js) dan simpan ke storage.
     *
     * Endpoint: POST /dashboard/editor/upload
     * Payload : multipart/form-data, key "image"
     * Header  : X-CSRF-TOKEN (dikirim otomatis oleh frontend)
     *
     * Response sukses (200):
     *   { "url": "https://..." }
     *
     * Response gagal (422 / 400):
     *   { "message": "...", "errors": {...} }
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|file|image|max:2048',
        ]);

        $path = $request->file('image')->store('editor/images', 'public');

        return response()->json([
            'url' => Storage::disk('public')->url($path),
        ]);
    }
}
