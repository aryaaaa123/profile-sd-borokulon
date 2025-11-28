<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{Announcement, Post, GalleryItem};

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_active', true)
            ->latest()->take(10)->get();

        $beritaTerbaru = \App\Models\Post::published()->latest('published_at')->take(3)->get();


        $galeriTerbaru = \App\Models\GalleryItem::latest()->take(3)->get();


        // bisa juga ambil sambutan/visi-misi dari config/DB jika mau editable
        return view('home', compact('announcements','beritaTerbaru','galeriTerbaru'));
    }
}
