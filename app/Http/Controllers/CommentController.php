<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'http://localhost:8000/api';  // Update the API base URL
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string'
        ]);

        // Prepare the data for the API request
        $commentData = [
            'post_id' => $request->post_id,
            'name' => $request->name ?: 'Anonim',  // Default name if not provided
            'content' => $request->content,
        ];

        try {
            // Send a POST request to the API to store the comment
            $response = $this->client->request('POST', $this->baseUrl . '/comments', [
                'json' => $commentData
            ]);

            // Handle API response
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            if ($contentArray['success']) {
                // Check if the request was successful and return the response
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Komentar berhasil ditambahkan',
                        'comment' => [
                            'name' => $contentArray['comment']['name'],
                            'content' => $contentArray['comment']['content'],
                            'created_at' => $contentArray['comment']['created_at']
                        ]
                    ]);
                }

                // If not an AJAX request, redirect with success message
                return back()->with('success', 'Komentar berhasil ditambahkan');
            } else {
                // If API response indicates failure
                return back()->with('error', 'Gagal menambahkan komentar');
            }
        } catch (\Exception $e) {
            // Handle any exceptions (e.g., API down, network issue)
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi');
        }
    }
}
