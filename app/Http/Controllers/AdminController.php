<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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
        $response = $this->client->request('GET', $this->baseUrl . '/users');
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('admin.petugas.index', compact('data'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $response = $this->client->request('POST', $this->baseUrl . '/users', [
            'json' => [
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Petugas Berhasil Ditambahkan');
        return redirect('/petugas');
    }

    public function edit($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . '/users/' . $id);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('admin.petugas.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = $request->password;
        }

        $response = $this->client->request('PUT', $this->baseUrl . '/users/' . $id, [
            'json' => $data
        ]);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Petugas Berhasil Diupdate');
        return redirect('/petugas');
    }

    public function delete($id)
    {
        $response = $this->client->request('DELETE', $this->baseUrl . '/users/' . $id);

        toastr()->timeOut(10000)->closeButton()->addSuccess('Petugas Berhasil Dihapus');
        return redirect()->back();
    }
}
