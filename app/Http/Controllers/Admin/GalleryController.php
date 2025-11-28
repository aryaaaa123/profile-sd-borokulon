<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    // Ambil daftar kategori dari config
    protected function categories(): array
    {
        return config('gallery.categories', []); // contoh: ['Kegiatan','Prestasi','Fasilitas','Umum']
    }

    public function index()
    {
        $items = GalleryItem::latest()->paginate(24);
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        $categories = $this->categories();
        return view('admin.gallery.create', compact('categories'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'title'    => ['nullable','max:150'],
            'category' => ['nullable','max:60', Rule::in($this->categories())],
            'image'    => ['required','image','max:3072'],
        ]);

        $data['image_path'] = $r->file('image')->store('gallery', 'public');

        GalleryItem::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto ditambahkan.');
    }

    public function edit(GalleryItem $gallery)
    {
        $categories = $this->categories();
        return view('admin.gallery.edit', compact('gallery','categories'));
    }

    public function update(Request $r, GalleryItem $gallery)
    {
        $data = $r->validate([
            'title'    => ['nullable','max:150'],
            'category' => ['nullable','max:60', Rule::in($this->categories())],
            'image'    => ['nullable','image','max:3072'],
        ]);

        if ($r->hasFile('image')) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $r->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return back()->with('success', 'Foto diperbarui.');
    }

    public function destroy(GalleryItem $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();

        return back()->with('success', 'Foto dihapus.');
    }
}
