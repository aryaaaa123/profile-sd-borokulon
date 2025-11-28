<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SarprasController extends Controller
{
    public function index()
    {
        $items = Sarpras::orderBy('sort_order')->orderByDesc('id')->paginate(15);
        return view('admin.sarpras.index', compact('items'));
    }

    public function create()
    {
        return view('admin.sarpras.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:150',
            'icon'        => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sarpras', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        Sarpras::create($data);

        return redirect()->route('admin.sarpras.index')->with('success', 'Sarana/Prasarana ditambahkan.');
    }

    // Route Model Binding parameter harus {sarpras}
    public function edit(\App\Models\Sarpras $sarpras)
{
    return view('admin.sarpras.edit', compact('sarpras')); // kirim $sarpras
}

    public function update(Request $request, Sarpras $sarpras)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:150',
            'icon'        => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($sarpras->image) {
                Storage::disk('public')->delete($sarpras->image);
            }
            $data['image'] = $request->file('image')->store('sarpras', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $sarpras->update($data);

        return redirect()->route('admin.sarpras.index')->with('success', 'Sarana/Prasarana diperbarui.');
    }

    public function destroy(Sarpras $sarpras)
    {
        if ($sarpras->image) {
            Storage::disk('public')->delete($sarpras->image);
        }
        $sarpras->delete();

        return back()->with('success', 'Sarana/Prasarana dihapus.');
    }
}
