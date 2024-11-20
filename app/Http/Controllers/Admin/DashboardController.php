<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Visitor;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('API_URL', 'http://localhost:8000/api');
    }

    public function index()
    {
        $recent_posts = Post::with(['category', 'gallery.images'])
            ->where('status', 'publish')
            ->latest()
            ->take(3)
            ->get();

        $data = [
            'total_posts' => Post::count(),
            'total_images' => Image::count(),
            'visitor_count' => Visitor::count(),
            'recent_posts' => $recent_posts
        ];

        return view('admin.dashboard.index', $data);
    }
}
