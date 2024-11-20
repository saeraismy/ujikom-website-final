<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('guest.index', [
            'images' => $images
        ]);
    }
}
