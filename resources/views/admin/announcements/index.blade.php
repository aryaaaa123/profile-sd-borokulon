@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold mb-0">Pengumuman Berjalan</h1>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif

<div class="card border-0 shadow-sm">
  <div class="card-body">
    {{-- Form Tambah Pengumuman --}}
    <form action="{{ route('admin.ann.store') }}" method="POST" class="row g-3 mb-4">
      @csrf
      <div class="col-lg-9">
        <input type="text" name="text" class="form-control" placeholder="Tulis pengumuman baru..." required>
      </div>
      <div class="col-lg-3 text-end">
        <button class="btn btn-primary w-100">
          <i class="bi bi-plus-circle me-1"></i> Tambah
        </button>
      </div>
    </form>

    {{-- Daftar Pengumuman --}}
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Isi Pengumuman</th>
          <th>Status</th>
          <th width="200" class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($announcements as $a)
          <tr>
            <td>{{ $a->text }}</td>
            <td>
              @if($a->is_active)
                <span class="badge bg-success">Aktif</span>
              @else
                <span class="badge bg-secondary">Nonaktif</span>
              @endif
            </td>
            <td class="text-end">
              <form action="{{ route('admin.ann.toggle', $a->id) }}" method="POST" class="d-inline">
                @csrf @method('PATCH')
                <button class="btn btn-sm btn-outline-warning">
                  <i class="bi bi-toggle-{{ $a->is_active ? 'on' : 'off' }}"></i>
                  {{ $a->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                </button>
              </form>

              <form action="{{ route('admin.ann.destroy', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengumuman ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="3" class="text-center text-muted py-3">Belum ada pengumuman.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
