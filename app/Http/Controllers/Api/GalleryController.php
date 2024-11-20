<?php

namespace App\Http\Controllers\Api;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with(['post', 'images'])->get();
        if ($galleries->count() > 0) {
            return GalleryResource::collection($galleries);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No galleries found'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'posisi' => 'required|integer',
            'status' => 'required|in:Aktif,Tidak-Aktif'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandatory',
                'error' => $validator->messages(),
            ], 422);
        }

        $gallery = Gallery::create([
            'post_id' => $request->post_id,
            'posisi' => $request->posisi,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Gallery Created Successfully',
            'data' => new GalleryResource($gallery),
        ], 201);
    }

    public function show(Gallery $gallery)
    {
        return new GalleryResource($gallery->load(['post', 'images']));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'posisi' => 'required|integer',
            'status' => 'required|in:Aktif,Tidak-Aktif'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandatory',
                'error' => $validator->messages(),
            ], 422);
        }

        $gallery->update([
            'post_id' => $request->post_id,
            'posisi' => $request->posisi,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Gallery Updated Successfully',
            'data' => new GalleryResource($gallery->load(['post', 'images'])),
        ], 200);
    }

    public function destroy(Gallery $gallery)
    {
        try {
            $gallery->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery Berhasil Dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus gallery: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getByPost($postId)
    {
        $gallery = Gallery::with('images')
            ->where('post_id', $postId)
            ->where('status', 'Aktif')
            ->first();

        if ($gallery) {
            return response()->json([
                'status' => 'success',
                'data' => new GalleryResource($gallery)
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Gallery not found'
        ], 404);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        $galleries = Gallery::with(['post', 'images'])
            ->where(function ($query) use ($search) {
                $query->whereHas('post', function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%');
                })
                    ->orWhere('posisi', $search); // Mencari berdasarkan posisi
            })
            ->get();

        if ($galleries->count() > 0) {
            return response()->json([
                'status' => 'success',
                'data' => GalleryResource::collection($galleries)
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No galleries found',
                'data' => []
            ], 200);
        }
    }
}
