@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 fw-bold mb-0">Guru & Tendik</h1>
  <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg me-1"></i> Tambah
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead class="table-light">
      <tr>
        <th>Foto</th>
        <th>Nama</th>
        <th>Peran</th>
        <th>Mapel/Jabatan</th>
        <th style="width:150px"></th>
      </tr>
      </thead>
      <tbody>
      @forelse($items as $it)
        <tr>
          <td style="width:70px">
            <img src="{{ $it->photo_url }}" style="width:56px;height:56px;object-fit:cover" class="rounded">
          </td>
          <td>{{ $it->name }}</td>
          <td class="text-capitalize">{{ $it->role }}</td>
          <td>{{ $it->role == 'guru' ? ($it->subject ?: '-') : ($it->position ?: '-') }}</td>
          <td class="text-end">
            <a href="{{ route('admin.staff.edit', $it) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('admin.staff.destroy', $it) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin hapus data ini?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="card-body">{{ $items->links() }}</div>
</div>
@endsection
