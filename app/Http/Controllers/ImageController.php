<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'http://localhost:8000/api';
    }

    public function create(Request $request)
    {
        $request->validate([
            'gallery_id' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heic|max:2028',
            'judul' => 'required',
        ]);

        $multipart = [
            [
                'name' => 'gallery_id',
                'contents' => $request->gallery_id
            ],
            [
                'name' => 'judul',
                'contents' => $request->judul
            ],
            [
                'name' => 'file',
                'contents' => fopen($request->file('file')->getPathname(), 'r'),
                'filename' => $request->file('file')->getClientOriginalName(),
                'headers' => [
                    'Content-Type' => $request->file('file')->getMimeType()
                ]
            ]
        ];

        $response = $this->client->request('POST', $this->baseUrl . '/images', [
            'multipart' => $multipart
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Foto Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function delete($id)
    {
        $response = $this->client->request('DELETE', $this->baseUrl . '/images/' . $id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Foto Berhasil Dihapus');
        return redirect()->back();
    }
}
