<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::get();
        if ($comments->count() > 0) {
            return CommentResource::collection($comments);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No comments found'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
            ], 422);
        }

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'name' => $request->name ?: 'Anonim',
            'content' => $request->content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil ditambahkan',
            'comment' => new CommentResource($comment),
        ], 201);
    }

    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    public function update(Request $request, $id)
    {
        // Find the comment by ID
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found'
            ], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'name' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Updating the comment
        $comment->update([
            'name' => $request->name ?: $comment->name,
            'content' => $request->content
        ]);

        // Returning JSON response
        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil diperbarui',
            'comment' => [
                'id' => $comment->id,
                'name' => $comment->name,
                'content' => $comment->content,
                'updated_at' => $comment->updated_at->diffForHumans(),
            ]
        ], 200);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'message' => 'Comment Deleted Successfully',
        ], 200);
    }
}
