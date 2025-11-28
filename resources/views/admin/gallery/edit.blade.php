@extends('layouts.admin')
@section('content')
<h1 class="h4 fw-bold mb-3">Edit Foto Galeri</h1>

<form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm border-0">
@csrf
@method('PUT')

<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Judul</label>
    <input name="title" class="form-control" value="{{ old('title', $gallery->title) }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Kategori</label>
    <select name="category" class="form-select">
      <option value="">— Pilih Kategori —</option>
      @foreach($categories as $c)
        <option value="{{ $c }}" {{ old('category', $gallery->category) === $c ? 'selected' : '' }}>{{ $c }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Gambar</label>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if($gallery->image_path)
      <img src="{{ asset('storage/'.$gallery->image_path) }}" class="mt-2 rounded" style="width:120px; height:120px; object-fit:cover;">
    @endif
  </div>
</div>

<div class="mt-3">
  <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Update</button>
  <a href="{{ route('admin.gallery.index') }}" class="btn btn-light">Batal</a>
</div>
</form>
@endsection
