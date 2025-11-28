<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  // App\Http\Controllers\Front\NewsController.php

public function index(Request $r)
{
    $q   = trim((string) $r->get('q', ''));
    $cat = (string) $r->get('category', '');

    $posts = \App\Models\Post::query()
        ->when($q, function ($qb) use ($q) {
            $qb->where(function ($q2) use ($q) {
                $q2->where('title', 'like', "%{$q}%")
                   ->orWhere('content', 'like', "%{$q}%")
                   ->orWhere('excerpt', 'like', "%{$q}%");
            });
        })
        ->when($cat !== '', fn($qb) => $qb->where('category', $cat))
        ->orderByDesc('published_at')
        ->orderByDesc('created_at')
        ->get(); // ⬅️ tampilkan semua

    $categories = \App\Models\Post::query()
        ->whereNotNull('category')
        ->where('category', '!=', '')
        ->distinct()
        ->pluck('category');

    return view('berita.index', [
        'posts'      => $posts,
        'categories' => $categories,
        'q'          => $q,
        'cat'        => $cat,
    ]);
}


  public function show($slug)
  {
    $post = Post::where('slug',$slug)->published()->firstOrFail();
    $related = Post::published()
      ->where('id','!=',$post->id)
      ->when($post->category, fn($x)=>$x->where('category',$post->category))
      ->latest('published_at')->take(4)->get();

    return view('berita.show', compact('post','related'));
  }
}
