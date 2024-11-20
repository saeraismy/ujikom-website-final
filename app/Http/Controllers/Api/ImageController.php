<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::with('gallery')->get();
        if($images->count() > 0)
        {
            return ImageResource::collection($images);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No images found'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gallery_id' => 'required|exists:galleries,id',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heic|max:2028',
            'judul' => 'required|string|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandatory',
                'error' => $validator->messages(),
            ], 422);
        }

        $file = $request->file('file');
        $filename = time() . '.' . $file->extension();
        $file->move(public_path('images'), $filename);

        $image = Image::create([
            'gallery_id' => $request->gallery_id,
            'file' => $filename,
            'judul' => $request->judul,
        ]);

        return response()->json([
            'message' => 'Image Created Successfully',
            'data' => new ImageResource($image),
        ], 201);
    }

    public function show(Image $image)
    {
        return new ImageResource($image->load('gallery'));
    }

    public function destroy(Image $image)
    {
        $filePath = public_path('images/' . $image->file);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $image->delete();
        return response()->json([
            'message' => 'Image Deleted Successfully',
        ], 200);
    }

    public function count()
    {
        $count = Image::count();
        return response()->json([
            'count' => $count
        ]);
    }
}
