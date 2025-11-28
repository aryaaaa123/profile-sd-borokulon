@extends('layouts.admin')
@section('content')
<h1 class="h4 fw-bold mb-3">Tambah Berita</h1>
<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm border-0">
@csrf
<div class="row g-3">
  <div class="col-md-8">
    <label class="form-label">Judul *</label>
    <input name="title" class="form-control" required value="{{ old('title') }}">
  </div>
 {{-- Kategori (dropdown) --}}
<div class="col-md-4">
  <label class="form-label">Kategori</label>
  <select name="category" class="form-select">
    <option value="">— Pilih Kategori —</option>
    @foreach($categories as $c)
      <option value="{{ $c }}" {{ old('category', $post->category ?? null) === $c ? 'selected' : '' }}>
        {{ $c }}
      </option>
    @endforeach
  </select>
</div>
  <div class="col-md-4">
    <label class="form-label">Author</label>
    <input name="author" class="form-control" value="{{ old('author') }}">
  </div>
  {{-- Tanggal Terbit --}}
<div class="col-md-4">
  <label class="form-label">Tanggal Terbit</label>
  <input type="datetime-local" name="published_at" class="form-control"
         value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
</div>
  <div class="col-md-4">
    <label class="form-label">Sampul</label>
    <input type="file" name="cover" class="form-control" accept="image/*">
  </div>
  <div class="col-12">
    <label class="form-label">Ringkasan</label>
    <textarea name="excerpt" rows="2" class="form-control">{{ old('excerpt') }}</textarea>
  </div>
  <div class="col-12">
    <label class="form-label">Konten *</label>
    <textarea name="content" rows="8" class="form-control" required>{{ old('content') }}</textarea>
  </div>
</div>
<div class="mt-3">
  <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
  <a href="{{ route('admin.posts.index') }}" class="btn btn-light">Batal</a>
</div>
</form>
@endsection
