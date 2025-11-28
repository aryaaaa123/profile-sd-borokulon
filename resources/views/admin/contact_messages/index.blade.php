@extends('layouts.admin')
@section('content')
<h1 class="h4 fw-bold mb-3">Pesan Masuk</h1>
<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead class="table-light"><tr><th>Nama</th><th>Email</th><th>Subjek</th><th>Tanggal</th><th style="width:120px"></th></tr></thead>
      <tbody>
      @forelse($items as $m)
        <tr>
          <td>{{ $m->name }}</td>
          <td>{{ $m->email }}</td>
          <td>{{ $m->subject ?: '—' }}</td>
          <td>{{ $m->created_at->format('d M Y H:i') }}</td>
          <td class="text-end">
            <a href="{{ route('admin.contact.show',$m) }}" class="btn btn-sm btn-outline-primary">Baca</a>
            <form action="{{ route('admin.contact.destroy',$m) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pesan.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="card-body">{{ $items->links() }}</div>
</div>
@endsection
