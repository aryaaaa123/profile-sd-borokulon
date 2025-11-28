@extends('layouts.admin')

@section('content')
  <h1 class="h4 fw-bold mb-3">Tambah Sarana/Prasarana</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Periksa kembali:</strong>
      <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
    </div>
  @endif

  <form action="{{ route('admin.sarpras.store') }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-3">
    @csrf

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Judul *</label>
        <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">Icon (Bootstrap Icons)</label>
        <input type="text" name="icon" class="form-control" placeholder="cth: bi-pc-display" value="{{ old('icon') }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">Urutan</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}">
      </div>

      <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
      </div>

      <div class="col-md-6">
        <label class="form-label">Gambar</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="form-text">Maks 2MB. Disarankan rasio 4:3 / 16:9.</div>
      </div>

      <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
          <label class="form-check-label" for="is_active">Aktif</label>
        </div>
      </div>
    </div>

    <div class="mt-3">
      <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
      <a href="{{ route('admin.sarpras.index') }}" class="btn btn-light">Batal</a>
    </div>
  </form>
@endsection
