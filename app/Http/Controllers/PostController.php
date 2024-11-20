<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    protected $client;
    protected $baseUrl;
    protected $perPage = 3;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'http://localhost:8000/api';
    }

    public function index()
    {
        $page = request()->get('page', 1);
        $response = $this->client->request('GET', $this->baseUrl . '/posts');
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        // Mengambil semua data
        $allPosts = collect($contentArray['data']);

        // Menghitung offset berdasarkan halaman
        $offset = ($page - 1) * $this->perPage;

        // Mengambil hanya 3 item untuk halaman saat ini
        $currentPagePosts = $allPosts->slice($offset, $this->perPage)->values();

        // Membuat paginator
        $posts = new LengthAwarePaginator(
            $currentPagePosts,
            $allPosts->count(),
            $this->perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $response = $this->client->request('GET', $this->baseUrl . '/categories');
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $category = $contentArray['data'];
        return view('admin.post.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'category_id' => 'required',
            'status' => 'required|in:publish,draft',
            'tanggal' => 'nullable|date'
        ]);

        $response = $this->client->request('POST', $this->baseUrl . '/posts', [
            'json' => [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'tanggal' => $request->tanggal,
                'petugas_id' => Auth::id()
            ]
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Post Berhasil Ditambahkan');
        return redirect('/post');
    }

    public function edit($id)
    {
        $postResponse = $this->client->request('GET', $this->baseUrl . '/posts/' . $id);
        $postContent = $postResponse->getBody()->getContents();
        $postArray = json_decode($postContent, true);
        $data = $postArray['data'];

        $categoryResponse = $this->client->request('GET', $this->baseUrl . '/categories');
        $categoryContent = $categoryResponse->getBody()->getContents();
        $categoryArray = json_decode($categoryContent, true);
        $category = $categoryArray['data'];

        return view('admin.post.edit', compact('data', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'category_id' => 'required',
            'status' => 'required|in:publish,draft',
            'tanggal' => 'nullable|date'
        ]);

        $response = $this->client->request('PUT', $this->baseUrl . '/posts/' . $id, [
            'json' => [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'tanggal' => $request->tanggal
            ]
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Post Berhasil Diperbarui');
        return redirect('/post');
    }

    public function delete($id)
    {
        $response = $this->client->request('DELETE', $this->baseUrl . '/posts/' . $id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Post Berhasil Dihapus');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        try {
            $search = $request->search;
            $page = $request->get('page', 1);

            $response = $this->client->request('GET', $this->baseUrl . '/posts/search', [
                'query' => ['search' => $search]
            ]);

            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            // Mengambil data posts dari response
            $allPosts = collect($contentArray['data']);

            // Menghitung offset berdasarkan halaman
            $offset = ($page - 1) * $this->perPage;

            // Mengambil hanya 3 item untuk halaman saat ini
            $currentPagePosts = $allPosts->slice($offset, $this->perPage)->values();

            // Membuat paginator
            $posts = new LengthAwarePaginator(
                $currentPagePosts,
                $allPosts->count(),
                $this->perPage,
                $page,
                ['path' => request()->url(), 'query' => ['search' => $search]]
            );

            return view('admin.post.index', compact('posts'));
        } catch (\Exception $e) {
            toastr()->timeOut(10000)->closeButton()->addError('Terjadi kesalahan saat mencari data');
            return redirect()->back();
        }
    }
}
