<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        if($categories->count() > 0)
        {
            return CategoryResource::collection($categories);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No categories found'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }

        $category = Category::create([
            'judul' => $request->judul,
        ]);

        return response()->json([
            'message' => 'Product Created Successfuly',
            'data' => new CategoryResource($category),
        ], 200);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }

        $category->update([
            'judul' => $request->judul,
        ]);

        return response()->json([
            'message' => 'Product Updated Successfuly',
            'data' => new CategoryResource($category),
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Product Deleted Successfuly',
        ], 200);
    }
}
