<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
  public function index(Request $request)
  {
    $cat = trim($request->get('category',''));
    $q   = trim($request->get('q',''));

    $items = GalleryItem::when($cat, fn($x)=>$x->where('category',$cat))
      ->when($q, fn($x)=>$x->where(function($w) use($q){
        $w->where('title','like',"%$q%")->orWhere('category','like',"%$q%");
      }))
      ->latest()->paginate(12)->withQueryString();

    $categories = GalleryItem::select('category')->whereNotNull('category')
      ->distinct()->orderBy('category')->pluck('category');

    return view('galeri.index', compact('items','categories','cat','q'));
  }
}
