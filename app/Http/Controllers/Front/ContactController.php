<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index()
  {
    return view('hubungi.index');
  }

  public function store(Request $request)
  {
    // Honeypot: jika terisi, anggap bot
    if ($request->filled('hp_field')) {
      return back()->with('success', 'Pesan terkirim. Terima kasih!');
    }

    $data = $request->validate([
      'name'    => 'required|string|max:100',
      'email'   => 'required|email|max:150',
      'subject' => 'nullable|string|max:150',
      'phone'   => 'nullable|string|max:30',
      'message' => 'required|string|max:2000',
    ]);

    $data['ip'] = $request->ip();

    ContactMessage::create($data);

    return back()->with('success', 'Pesan Anda berhasil dikirim. Terima kasih!');
  }
}
