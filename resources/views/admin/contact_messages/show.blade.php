@extends('layouts.admin')
@section('content')
<h1 class="h4 fw-bold mb-3">Detail Pesan</h1>
<div class="card shadow-sm">
  <div class="card-body">
    <div class="mb-2"><strong>Nama:</strong> {{ $item->name }}</div>
    <div class="mb-2"><strong>Email:</strong> {{ $item->email }}</div>
    <div class="mb-2"><strong>Telepon:</strong> {{ $item->phone ?: '—' }}</div>
    <div class="mb-2"><strong>Subjek:</strong> {{ $item->subject ?: '—' }}</div>
    <div class="mb-3"><strong>Tanggal:</strong> {{ $item->created_at->format('d M Y H:i') }}</div>
    <div class="border rounded p-3 bg-light"><pre class="m-0" style="white-space:pre-wrap">{{ $item->message }}</pre></div>
    <div class="mt-3">
      <form action="{{ route('admin.contact.destroy',$item) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
        @csrf @method('DELETE')
        <button class="btn btn-outline-danger">Hapus</button>
        <a href="{{ route('admin.contact.index') }}" class="btn btn-light">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection
