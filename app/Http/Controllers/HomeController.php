<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('admin.index');
    }

    public function home()
    {
        try {
            // Mengambil informasi (category_id = 1)
            $informasiResponse = $this->client->request('GET', $this->baseUrl . '/posts');
            $informasiContent = json_decode($informasiResponse->getBody()->getContents(), true);
            $allPosts = collect($informasiContent['data']);

            // Filter informasi dan muat gallery beserta images
            $informasi = $allPosts->filter(function ($post) {
                return $post['category_id'] == 1 && $post['status'] == 'publish';
            })->map(function ($post) {
                // Ambil gallery untuk post ini
                try {
                    $galleryResponse = $this->client->request('GET', $this->baseUrl . '/galleries/by-post/' . $post['id']);
                    $galleryContent = json_decode($galleryResponse->getBody()->getContents(), true);
                    $post['gallery'] = $galleryContent['data'];
                } catch (\Exception $e) {
                    $post['gallery'] = null;
                }
                return $post;
            })->sortByDesc('created_at')->values();

            // Mengambil agenda (category_id = 2) dan muat gallery
            $agenda = $allPosts->filter(function ($post) {
                return $post['category_id'] == 2 && $post['status'] == 'publish';
            })->map(function ($post) {
                // Ambil gallery untuk post ini
                try {
                    $galleryResponse = $this->client->request('GET', $this->baseUrl . '/galleries/by-post/' . $post['id']);
                    $galleryContent = json_decode($galleryResponse->getBody()->getContents(), true);
                    $post['gallery'] = $galleryContent['data'];
                } catch (\Exception $e) {
                    $post['gallery'] = null;
                }
                return $post;
            })->sortByDesc('created_at')->values();

            // Mengambil galleries dan images
            $galleriesResponse = $this->client->request('GET', $this->baseUrl . '/galleries');
            $galleriesContent = json_decode($galleriesResponse->getBody()->getContents(), true);

            $images = collect($galleriesContent['data'])
                ->filter(function($gallery) {
                    return !empty($gallery['images']);
                })
                ->mapWithKeys(function($gallery) {
                    return [$gallery['id'] => [
                        'gallery_name' => $gallery['post']['judul'] ?? 'Galeri Lainnya',
                        'images' => $gallery['images']
                    ]];
                });

            return view('guest.index', compact('informasi', 'agenda', 'images'));
        } catch (\Exception $e) {
            return view('guest.index', [
                'informasi' => collect([]),
                'agenda' => collect([]),
                'images' => collect([])
            ]);
        }
    }
}
