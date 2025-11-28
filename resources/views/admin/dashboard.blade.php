{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<style>
  .kpi{
    border:1px solid var(--line);
    background:var(--card);
    border-radius:.9rem;
    box-shadow:0 10px 24px rgba(15,23,42,.06);
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .kpi:hover{ transform:translateY(-2px); box-shadow:0 16px 32px rgba(15,23,42,.08); }
  .kpi .icon{
    width:42px; height:42px; border-radius:.65rem; display:flex; align-items:center; justify-content:center;
    font-size:1.1rem;
  }
  .icon-blue{ background:rgba(13,110,253,.12); color:#0d6efd; border:1px solid rgba(13,110,253,.25); }
  .icon-green{ background:rgba(25,135,84,.12); color:#198754; border:1px solid rgba(25,135,84,.25); }
  .icon-orange{ background:rgba(255,193,7,.12); color:#fd7e14; border:1px solid rgba(255,193,7,.25); }
  .icon-pink{ background:rgba(214,51,132,.12); color:#d63384; border:1px solid rgba(214,51,132,.25); }

  .card-soft{ background:var(--card); border:1px solid var(--line); border-radius:.9rem; }
  .list-slim .row-item{ padding:.6rem .25rem; border-bottom:1px dashed var(--line); }
  .list-slim .row-item:last-child{ border-bottom:0; }
  .empty{
    border:1px dashed var(--line); background:transparent; border-radius:.75rem;
    padding:1rem; color:var(--muted); text-align:center;
  }

  .quick-btn{ border-radius:.7rem; }
</style>

{{-- Title + Quick actions --}}
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <h1 class="h4 fw-bold mb-0">Dashboard</h1>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary quick-btn"><i class="bi bi-plus-lg me-1"></i> Berita Baru</a>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-outline-primary quick-btn"><i class="bi bi-image me-1"></i> Upload Foto</a>
    <a href="{{ route('admin.sarpras.create') }}" class="btn btn-outline-secondary quick-btn"><i class="bi bi-building-add me-1"></i> Tambah Sarpras</a>
  </div>
</div>

{{-- KPI Cards --}}
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <div class="kpi p-3 h-100 d-flex align-items-center justify-content-between">
      <div>
        <div class="text-muted small">Berita</div>
        <div class="h4 mb-0">{{ $counts['posts'] }}</div>
      </div>
      <div class="icon icon-blue"><i class="bi bi-newspaper"></i></div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="kpi p-3 h-100 d-flex align-items-center justify-content-between">
      <div>
        <div class="text-muted small">Galeri</div>
        <div class="h4 mb-0">{{ $counts['gallery'] }}</div>
      </div>
      <div class="icon icon-green"><i class="bi bi-images"></i></div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="kpi p-3 h-100 d-flex align-items-center justify-content-between">
      <div>
        <div class="text-muted small">Sarpras</div>
        <div class="h4 mb-0">{{ $counts['sarpras'] }}</div>
      </div>
      <div class="icon icon-orange"><i class="bi bi-building"></i></div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="kpi p-3 h-100 d-flex align-items-center justify-content-between">
      <div>
        <div class="text-muted small">Pesan Masuk</div>
        <div class="h4 mb-0">{{ $counts['messages'] }}</div>
      </div>
      <div class="icon icon-pink"><i class="bi bi-inbox"></i></div>
    </div>
  </div>
</div>

<div class="row g-3">
  {{-- Berita Terbaru --}}
  <div class="col-lg-6">
    <div class="card-soft h-100">
      <div class="p-3 p-md-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h5 class="fw-bold text-primary mb-0"><i class="bi bi-newspaper me-1"></i> Berita Terbaru</h5>
          <a href="{{ route('admin.posts.index') }}" class="small text-decoration-none">Lihat semua</a>
        </div>

        @if($latestPosts->isEmpty())
          <div class="empty"><i class="bi bi-info-circle me-1"></i> Belum ada berita.</div>
        @else
          <div class="list-slim">
            @foreach($latestPosts as $p)
              <div class="row-item d-flex justify-content-between align-items-start">
                <div class="me-2">
                  <a href="{{ route('admin.posts.edit', $p->id) }}" class="text-decoration-none fw-semibold text-body">
                    {{ \Illuminate\Support\Str::limit($p->title, 72) }}
                  </a>
                  @if(!$p->published_at)
                    <span class="badge bg-warning-subtle text-warning border ms-2">Draft</span>
                  @endif
                </div>
                <small class="text-muted">
                  {{ $p->published_at ? $p->published_at->format('d M Y') : $p->updated_at->format('d M Y') }}
                </small>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>

  {{-- Pesan Terbaru --}}
  <div class="col-lg-6">
    <div class="card-soft h-100">
      <div class="p-3 p-md-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h5 class="fw-bold text-primary mb-0"><i class="bi bi-envelope-open me-1"></i> Pesan Terbaru</h5>
          <a href="{{ route('admin.contact.index') }}" class="small text-decoration-none">Lihat semua</a>
        </div>

        @if($latestMsgs->isEmpty())
          <div class="empty"><i class="bi bi-info-circle me-1"></i> Belum ada pesan.</div>
        @else
          <div class="list-slim">
            @foreach($latestMsgs as $m)
              <div class="row-item d-flex justify-content-between align-items-start">
                <div class="me-2">
                  <div class="fw-semibold">{{ $m->name }}</div>
                  <div class="text-muted small">
                    {{ \Illuminate\Support\Str::limit($m->subject ?: 'Tanpa subjek', 60) }}
                  </div>
                </div>
                <small class="text-muted">{{ $m->created_at->format('d M Y H:i') }}</small>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- Row opsional: Aktivitas Singkat / Info Sistem --}}
<div class="row g-3 mt-1">
  <div class="col-lg-6">
    <div class="card-soft">
      <div class="p-3 p-md-4">
        <h6 class="fw-bold mb-2"><i class="bi bi-clock-history me-1"></i> Aktivitas singkat</h6>
        <ul class="mb-0 small text-muted">
          <li>Gunakan tombol <strong>Berita Baru</strong> untuk membuat publikasi.</li>
          <li>Pastikan gambar berita & galeri telah diunggah ke <em>storage</em> (public).</li>
          <li>Cek menu <strong>Pesan Masuk</strong> untuk menindaklanjuti pertanyaan dari pengunjung.</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card-soft">
      <div class="p-3 p-md-4">
        <h6 class="fw-bold mb-2"><i class="bi bi-gear me-1"></i> Info sistem</h6>
        <div class="d-flex align-items-center justify-content-between small">
          <span class="text-muted">PHP</span><span class="fw-semibold">{{ PHP_VERSION }}</span>
        </div>
        <div class="d-flex align-items-center justify-content-between small">
          <span class="text-muted">Laravel</span><span class="fw-semibold">{{ app()->version() }}</span>
        </div>
        <div class="d-flex align-items-center justify-content-between small">
          <span class="text-muted">Waktu server</span><span class="fw-semibold">{{ now()->format('d M Y H:i') }}</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
