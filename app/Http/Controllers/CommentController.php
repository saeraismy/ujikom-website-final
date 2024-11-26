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
        $this->baseUrl = 'http://localhost:8000/api';
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string'
        ]);

        
        $commentData = [
            'post_id' => $request->post_id,
            'name' => $request->name ?: 'Anonim',  
            'content' => $request->content,
        ];

        try {
            
            $response = $this->client->request('POST', $this->baseUrl . '/comments', [
                'json' => $commentData
            ]);

            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            if ($contentArray['success']) {
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

                return back()->with('success', 'Komentar berhasil ditambahkan');
            } else {
                return back()->with('error', 'Gagal menambahkan komentar');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi');
        }
    }
}
