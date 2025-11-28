@extends('layouts.admin')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 fw-bold mb-0">Sarana & Prasarana</h1>
    <a href="{{ route('admin.sarpras.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> Tambah
    </a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Gagal:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="card border-0 shadow-sm">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Icon</th>
            <th>Urutan</th>
            <th>Status</th>
            <th style="width:140px"></th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $it)
            <tr>
              <td style="width:90px">
                <img src="{{ $it->image_url }}" class="rounded" style="width:80px;height:60px;object-fit:cover">
              </td>
              <td class="fw-semibold">{{ $it->title }}</td>
              <td>@if($it->icon)<i class="bi {{ $it->icon }}"></i>@else — @endif</td>
              <td>{{ $it->sort_order }}</td>
              <td>
                @if($it->is_active)
                  <span class="badge bg-success">Aktif</span>
                @else
                  <span class="badge bg-secondary">Nonaktif</span>
                @endif
              </td>
              <td class="text-end">
                <a href="{{ route('admin.sarpras.edit', $it) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('admin.sarpras.destroy', $it) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus item ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="card-body">{{ $items->links() }}</div>
  </div>
@endsection
