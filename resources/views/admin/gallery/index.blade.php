{{-- resources/views/admin/gallery/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<style>
  .card-soft{ background:var(--card); border:1px solid var(--line); border-radius:.9rem; }
  .toolbar{ background:var(--card); border:1px solid var(--line); border-radius:.9rem; }
  .thumb{ width:84px; height:64px; object-fit:cover; border-radius:.5rem; border:1px solid var(--line); }
  .empty{
    border:1px dashed var(--line); border-radius:.75rem; padding:1.25rem; color:var(--muted); text-align:center;
  }
  /* Table jadi stacked di mobile */
  @media (max-width: 768px){
    .table thead{ display:none; }
    .table tbody tr{ display:block; padding:.75rem 0; border-bottom:1px solid var(--line); }
    .table tbody td{ display:flex; justify-content:space-between; gap:.75rem; border:0; padding:.35rem .25rem; }
    .table tbody td::before{
      content: attr(data-th);
      font-weight:600; color:var(--muted);
    }
    .td-actions{ justify-content:flex-end; }
  }
</style>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <h1 class="h4 fw-bold mb-0">Galeri</h1>
  <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg me-1"></i> Tambah
  </a>
</div>

{{-- Toolbar pencarian & filter --}}
@php
  $cats = $categories ?? (config('gallery.categories', []) ?: []);
@endphp
<form class="toolbar p-3 mb-3" method="GET" action="{{ route('admin.gallery.index') }}">
  <div class="row g-2 align-items-center">
    <div class="col-sm-6 col-lg-5">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul/kategori…">
      </div>
    </div>
    <div class="col-sm-4 col-lg-3">
      <select name="category" class="form-select">
        @php $cat = request('category'); @endphp
        <option value="">Semua kategori</option>
        @foreach($cats as $c)
          <option value="{{ $c }}" {{ $cat===$c ? 'selected' : '' }}>{{ $c }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-sm-2 col-lg-2">
      <button class="btn btn-outline-primary w-100"><i class="bi bi-filter me-1"></i> Terapkan</button>
    </div>
    @if(request()->hasAny(['q','category']) && (request('q')!==null || request('category')!==null))
      <div class="col-12 col-lg-auto">
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">
          <i class="bi bi-x-lg me-1"></i> Hapus filter
        </a>
      </div>
    @endif
  </div>
</form>

<div class="card-soft">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th style="width:110px">Sampul</th>
          <th>Judul</th>
          <th style="width:180px">Kategori</th>
          <th style="width:160px">Diunggah</th>
          <th style="width:100px"></th>
        </tr>
      </thead>
      <tbody>
      @forelse($items as $g)
        <tr>
          <td data-th="Sampul">
            @if($g->image_path)
              <a href="#" data-bs-toggle="modal" data-bs-target="#previewModal"
                 data-src="{{ asset('storage/'.$g->image_path) }}"
                 data-title="{{ $g->title ?: 'Foto' }}">
                <img src="{{ asset('storage/'.$g->image_path) }}" alt="thumb" class="thumb">
              </a>
            @else
              <div class="thumb d-flex align-items-center justify-content-center bg-light text-muted">
                <i class="bi bi-image"></i>
              </div>
            @endif
          </td>
          <td data-th="Judul" class="fw-semibold">
            {{ \Illuminate\Support\Str::limit($g->title ?: 'Tanpa Judul', 90) }}
          </td>
          <td data-th="Kategori">
            @if($g->category)
              <span class="badge bg-primary-subtle text-primary">{{ $g->category }}</span>
            @else
              <span class="text-muted">—</span>
            @endif
          </td>
          <td data-th="Diunggah">
            {{ $g->created_at?->format('d M Y, H:i') }}
          </td>
          <td class="text-end td-actions" data-th="Aksi">
            <div class="btn-group">
              <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.gallery.edit',$g) }}">
                <i class="bi bi-pencil"></i>
              </a>
              <button class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"></button>
              <ul class="dropdown-menu dropdown-menu-end">
                @if($g->image_path)
                <li>
                  <a class="dropdown-item"
                     href="#"
                     data-bs-toggle="modal"
                     data-bs-target="#previewModal"
                     data-src="{{ asset('storage/'.$g->image_path) }}"
                     data-title="{{ $g->title ?: 'Foto' }}">
                    <i class="bi bi-eye me-2"></i>Preview
                  </a>
                </li>
                @endif
                <li><a class="dropdown-item" href="{{ asset('storage/'.$g->image_path) }}" target="_blank">
                  <i class="bi bi-box-arrow-up-right me-2"></i>Buka file</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('admin.gallery.destroy',$g) }}" method="POST"
                        onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Hapus</button>
                  </form>
                </li>
              </ul>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5">
            <div class="empty">
              <i class="bi bi-images me-1"></i> Belum ada foto. Klik <strong>Tambah</strong> untuk mengunggah.
            </div>
          </td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </div>

  <div class="p-3">
    {{ $items->withQueryString()->links() }}
  </div>
</div>

{{-- Modal Preview --}}
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewTitle">Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body p-0">
        <img id="previewImg" src="" alt="Preview" class="w-100 d-block" style="max-height:75vh;object-fit:contain">
      </div>
    </div>
  </div>
</div>

<script>
  // Isi modal preview dari atribut data
  const modal = document.getElementById('previewModal');
  modal?.addEventListener('show.bs.modal', function (e) {
    const trigger = e.relatedTarget;
    const src   = trigger?.getAttribute('data-src') || '';
    const title = trigger?.getAttribute('data-title') || 'Preview';
    document.getElementById('previewImg').src = src;
    document.getElementById('previewTitle').textContent = title;
  });
</script>
@endsection
