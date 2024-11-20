<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->get();
        if($posts->count() > 0)
        {
            return PostResource::collection($posts);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No posts found'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'petugas_id' => 'required|exists:users,id',
            'status' => 'required|in:publish,draft',
            'tanggal' => 'nullable|date'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }

        $post = Post::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'category_id' => $request->category_id,
            'petugas_id' => $request->petugas_id,
            'status' => $request->status,
            'tanggal' => $request->tanggal
        ]);

        return response()->json([
            'message' => 'Post Created Successfully',
            'data' => new PostResource($post),
        ], 201);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:publish,draft',
            'tanggal' => 'nullable|date'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }

        $post->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
            'petugas_id' => $post->petugas_id
        ]);

        return response()->json([
            'message' => 'Post Updated Successfully',
            'data' => new PostResource($post->load('user')),
        ], 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'Post Deleted Successfully',
        ], 200);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::with(['category', 'user'])
            ->where(function($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                      ->orWhereHas('category', function($q) use ($search) {
                          $q->where('judul', 'like', '%' . $search . '%');
                      });
            })
            ->get();

        if($posts->count() > 0) {
            return response()->json([
                'status' => 'success',
                'data' => PostResource::collection($posts)
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No posts found',
                'data' => []
            ], 200);
        }
    }
}
