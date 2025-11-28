@extends('layouts.admin')
@section('content')
<h1 class="h4 fw-bold mb-3">Edit Guru/Tendik</h1>

<form action="{{ route('admin.staff.update', $staff) }}" method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm border-0">
  @method('PUT')
  @include('admin.staff._form', ['staff'=>$staff, 'roles'=>$roles])
  <div class="mt-3 d-flex justify-content-between">
    <a href="{{ route('admin.staff.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
  </div>
</form>
@endsection
