<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest('published_at')->latest()->paginate(12);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = config('news.categories', []);
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'title'        => 'required|max:200',
            'category'     => 'nullable|max:60',
            'author'       => 'nullable|max:60',
            'excerpt'      => 'nullable|max:300',
            'content'      => 'required',
            'cover'        => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',   // ✅
        ]);

        if ($r->hasFile('cover')) {
            $data['cover'] = $r->file('cover')->store('posts', 'public');
        }

        $data['published_at'] = $r->filled('published_at')
            ? Carbon::parse($r->input('published_at'))
            : null;

        $data['slug'] = Str::slug($data['title']);

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Berita ditambahkan.');
    }

    public function edit(Post $post)
    {
        $categories = config('news.categories', []);
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]); // kirim $post
    }

    public function update(Request $r, Post $post)
    {
        $data = $r->validate([
            'title'        => 'required|max:200',
            'category'     => 'nullable|max:60',
            'author'       => 'nullable|max:60',
            'excerpt'      => 'nullable|max:300',
            'content'      => 'required',
            'cover'        => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',  // ✅
        ]);

        if ($r->hasFile('cover')) {
            if ($post->cover) Storage::disk('public')->delete($post->cover);
            $data['cover'] = $r->file('cover')->store('posts', 'public');
        }

        if ($post->title !== $r->title) {
            $data['slug'] = Str::slug($r->title);
        }

        $data['published_at'] = $r->filled('published_at')
            ? Carbon::parse($r->input('published_at'))
            : null;

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Berita diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->cover) Storage::disk('public')->delete($post->cover);
        $post->delete();
        return back()->with('success', 'Berita dihapus.');
    }
}
