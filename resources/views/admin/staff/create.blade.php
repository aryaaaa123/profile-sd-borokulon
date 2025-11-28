@extends('layouts.admin')
@section('content')
<h1 class="h4 fw-bold mb-3">Tambah Guru/Tendik</h1>

<form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm border-0">
  @include('admin.staff._form', ['staff' => new \App\Models\Staff(), 'roles'=>$roles])
  <div class="mt-3">
    <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
    <a href="{{ route('admin.staff.index') }}" class="btn btn-light">Batal</a>
  </div>
</form>
@endsection
