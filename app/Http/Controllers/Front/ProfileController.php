<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Staff;

class ProfileController extends Controller
{
    public function guruTendik()
    {
        $guru   = Staff::where('role','guru')->orderBy('name')->get();
        $tendik = Staff::where('role','tendik')->orderBy('name')->get();
        return view('profile.guru-tendik', compact('guru','tendik'));
    }
    public function sarpras()
{
  $items = \App\Models\Sarpras::active()->orderBy('sort_order')->orderBy('title')->get();
  return view('profile.sarpras', compact('items'));
}

    public function showSarpras($slug)
    {
        $sarpras = \App\Models\Sarpras::where('slug', $slug)->active()->firstOrFail();
        
        // Get related sarpras items (active only)
        $related = \App\Models\Sarpras::active()
            ->where('id', '!=', $sarpras->id)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->take(4)
            ->get();
        
        return view('profile.sarpras.show', compact('sarpras', 'related'));
    }

}
