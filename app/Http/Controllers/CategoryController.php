<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'http://localhost:8000/api';
    }

    public function index()
    {
        $response = $this->client->request('GET', $this->baseUrl . '/categories');
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('admin.category.index', compact('data'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $response = $this->client->request('POST', $this->baseUrl . '/categories', [
            'json' => [
                'judul' => $request->kategori,
            ]
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Kategori Berhasil Ditambahkan');
        return redirect('/category');
    }

    public function edit($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . '/categories/' . $id);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('admin.category.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $response = $this->client->request('PUT', $this->baseUrl . '/categories/' . $id, [
            'json' => [
                'judul' => $request->kategori,
            ]
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Kategori Berhasil Diupdate');
        return redirect('/category');
    }

    public function delete($id)
    {
        $response = $this->client->request('DELETE', $this->baseUrl . '/categories/' . $id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Kategori Berhasil Dihapus');
        return redirect()->back();
    }
}
