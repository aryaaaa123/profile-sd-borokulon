@extends('layouts.admin')

@section('content')
  <h1 class="h4 fw-bold mb-3">Edit Sarana/Prasarana</h1>

  <form action="{{ route('admin.sarpras.update', $sarpras) }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-3">
    @csrf @method('PUT')

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Judul *</label>
        <input type="text" name="title" class="form-control" required value="{{ old('title',$sarpras->title) }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">Icon (Bootstrap Icons)</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon',$sarpras->icon) }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">Urutan</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$sarpras->sort_order) }}">
      </div>

      <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description',$sarpras->description) }}</textarea>
      </div>

      <div class="col-md-6">
        <label class="form-label">Gambar</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="form-text">Biarkan kosong jika tidak ingin mengubah.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label d-block">Pratinjau</label>
        <img src="{{ $sarpras->image_url }}" class="rounded shadow-sm" style="width:220px;height:165px;object-fit:cover">
      </div>

      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $sarpras->is_active ? 'checked':'' }}>
          <label class="form-check-label" for="is_active">Aktif</label>
        </div>
      </div>
    </div>

    <div class="mt-3">
      <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
      <a href="{{ route('admin.sarpras.index') }}" class="btn btn-light">Kembali</a>
    </div>
  </form>
@endsection
