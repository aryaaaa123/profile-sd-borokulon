@extends('layouts.admin')
@section('content')
<h1 class="h4 fw-bold mb-3">Tambah Foto Galeri</h1>

<form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm border-0">
@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Judul</label>
    <input name="title" class="form-control" value="{{ old('title') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Kategori</label>
    <select name="category" class="form-select">
      <option value="">— Pilih Kategori —</option>
      @foreach($categories as $c)
        <option value="{{ $c }}" {{ old('category') === $c ? 'selected' : '' }}>{{ $c }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Gambar *</label>
    <input type="file" name="image" class="form-control" accept="image/*" required>
  </div>
</div>

<div class="mt-3">
  <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
  <a href="{{ route('admin.gallery.index') }}" class="btn btn-light">Batal</a>
</div>
</form>
@endsection
