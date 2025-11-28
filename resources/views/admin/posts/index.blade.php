{{-- resources/views/admin/posts/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<style>
  .card-soft{ background:var(--card); border:1px solid var(--line); border-radius:.9rem; }
  .thumb{ width:84px; height:64px; object-fit:cover; border-radius:.5rem; border:1px solid var(--line); }
  .badge-soft{
    background:rgba(13,110,253,.12); color:#0d6efd; border:1px solid rgba(13,110,253,.25);
  }
  .badge-draft{
    background:rgba(255,193,7,.12); color:#b46900; border:1px solid rgba(255,193,7,.25);
  }
  .badge-published{
    background:rgba(25,135,84,.12); color:#198754; border:1px solid rgba(25,135,84,.25);
  }
  .empty{
    border:1px dashed var(--line); border-radius:.75rem; padding:1.25rem; color:var(--muted); text-align:center;
  }
  @media (max-width: 768px){
    .table thead{ display:none; }
    .table tbody tr{ display:block; padding: .75rem; border-bottom:1px solid var(--line); }
    .table tbody td{ display:block; border:0; padding:.25rem 0; }
    .td-actions{ margin-top:.5rem; }
  }
</style>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <h1 class="h4 fw-bold mb-0">Berita</h1>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> Tambah
    </a>
  </div>
</div>

{{-- Filter bar --}}
<form class="card-soft p-3 p-md-3 mb-3" method="GET" action="{{ route('admin.posts.index') }}">
  <div class="row g-2 align-items-center">
    <div class="col-sm-6 col-lg-5">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul/konten…">
      </div>
    </div>
    <div class="col-sm-3 col-lg-2">
      <select name="status" class="form-select">
        @php $st = request('status'); @endphp
        <option value="">Semua status</option>
        <option value="published" {{ $st==='published' ? 'selected' : '' }}>Terbit</option>
        <option value="draft"     {{ $st==='draft' ? 'selected' : '' }}>Draft</option>
      </select>
    </div>
    <div class="col-sm-3 col-lg-2">
      <button class="btn btn-outline-primary w-100"><i class="bi bi-filter me-1"></i> Terapkan</button>
    </div>
    @if(request()->hasAny(['q','status']) && (request('q')!==null || request('status')!==null))
      <div class="col-12 col-lg-auto">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg me-1"></i> Hapus filter</a>
      </div>
    @endif
  </div>
</form>

<div class="card-soft">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th style="width:100px">Sampul</th>
          <th>Judul</th>
          <th style="width:160px">Kategori</th>
          <th style="width:140px">Status</th>
          <th style="width:140px">Terbit</th>
          <th style="width:72px"></th>
        </tr>
      </thead>
      <tbody>
      @forelse($posts as $p)
        <tr>
          <td>
            @if($p->cover)
              <img src="{{ asset('storage/'.$p->cover) }}" class="thumb" alt="cover">
            @else
              <div class="thumb d-flex align-items-center justify-content-center bg-light text-muted">
                <i class="bi bi-image"></i>
              </div>
            @endif
          </td>
          <td class="fw-semibold">
            <a href="{{ route('admin.posts.edit',$p) }}" class="text-decoration-none text-body">
              {{ \Illuminate\Support\Str::limit($p->title, 90) }}
            </a>
          </td>
          <td>
            @if($p->category)
              <span class="badge badge-soft">{{ $p->category }}</span>
            @else
              <span class="text-muted">—</span>
            @endif
          </td>
          <td>
            @if($p->published_at)
              <span class="badge badge-published"><i class="bi bi-check-circle me-1"></i>Terbit</span>
            @else
              <span class="badge badge-draft"><i class="bi bi-pencil-square me-1"></i>Draft</span>
            @endif
          </td>
          <td>
            {{ $p->published_at ? $p->published_at->format('d M Y') : '—' }}
          </td>
          <td class="text-end td-actions">
            <div class="btn-group">
              <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.posts.edit',$p) }}">
                <i class="bi bi-pencil"></i>
              </a>
              <button class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"></button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="{{ route('berita.show', $p->slug) }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right me-2"></i>Lihat publik
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('admin.posts.destroy',$p) }}" method="POST"
                        onsubmit="return confirm('Hapus berita ini?')">
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
          <td colspan="6">
            <div class="empty">
              <i class="bi bi-info-circle me-1"></i> Belum ada data berita. Klik <strong>Tambah</strong> untuk membuat.
            </div>
          </td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </div>

  <div class="p-3">
    {{ $posts->withQueryString()->links() }}
  </div>
</div>
@endsection
