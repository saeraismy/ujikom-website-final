<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GalleryController extends Controller
{
    protected $client;
    protected $baseUrl;
    protected $perPage = 3; // Jumlah item per halaman

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'http://localhost:8000/api';
    }

    public function index()
    {
        $page = request()->get('page', 1);
        $response = $this->client->request('GET', $this->baseUrl . '/galleries');
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $allData = collect($contentArray['data']);

        $offset = ($page - 1) * $this->perPage;

        $currentPageData = $allData->slice($offset, $this->perPage)->values();

        $data = new LengthAwarePaginator(
            $currentPageData,
            $allData->count(),
            $this->perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('admin.gallery.index', compact('data'));
    }

    public function create()
    {
        $response = $this->client->request('GET', $this->baseUrl . '/posts');
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $posts = $contentArray['data'];
        return view('admin.gallery.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'posisi' => 'required|integer',
            'status' => 'required|in:Aktif,Tidak-Aktif'
        ]);

        $response = $this->client->request('POST', $this->baseUrl . '/galleries', [
            'json' => [
                'post_id' => $request->post_id,
                'posisi' => $request->posisi,
                'status' => $request->status
            ]
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Gallery Berhasil Ditambahkan');
        return redirect('/gallery');
    }

    public function show($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . '/galleries/' . $id);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $gallery = $contentArray['data'];
        return view('admin.gallery.show', compact('gallery'));
    }

    public function edit($id)
    {
        $galleryResponse = $this->client->request('GET', $this->baseUrl . '/galleries/' . $id);
        $galleryContent = $galleryResponse->getBody()->getContents();
        $galleryArray = json_decode($galleryContent, true);
        $data = $galleryArray['data'];

        $postsResponse = $this->client->request('GET', $this->baseUrl . '/posts');
        $postsContent = $postsResponse->getBody()->getContents();
        $postsArray = json_decode($postsContent, true);
        $posts = $postsArray['data'];

        return view('admin.gallery.edit', compact('data', 'posts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'post_id' => 'required',
            'posisi' => 'required|integer',
            'status' => 'required|in:Aktif,Tidak-Aktif'
        ]);

        $response = $this->client->request('PUT', $this->baseUrl . '/galleries/' . $id, [
            'json' => [
                'post_id' => $request->post_id,
                'posisi' => $request->posisi,
                'status' => $request-> status
            ]
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Gallery Berhasil Diperbarui');
        return redirect('/gallery');
    }

    public function delete($id)
    {
        $response = $this->client->request('DELETE', $this->baseUrl . '/galleries/' . $id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Gallery Berhasil Dihapus');
        return redirect()->back();
    }
}
