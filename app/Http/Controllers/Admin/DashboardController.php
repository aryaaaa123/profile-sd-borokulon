<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\GalleryItem;
use App\Models\Sarpras;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'posts'   => Post::count(),
                'gallery' => GalleryItem::count(),
                'sarpras' => Sarpras::count(),
                'messages'=> ContactMessage::count(),
            ],
            'latestPosts' => Post::latest('published_at')->latest()->take(5)->get(),
            'latestMsgs'  => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
