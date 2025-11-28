<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
  public function index(){
    $items = ContactMessage::latest()->paginate(20);
    return view('admin.contact_messages.index', compact('items'));
  }
  public function show(ContactMessage $contactMessage){
    return view('admin.contact_messages.show', ['item'=>$contactMessage]);
  }
  public function destroy(ContactMessage $contactMessage){
    $contactMessage->delete();
    return back()->with('success','Pesan dihapus.');
  }
}
