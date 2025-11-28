@extends('layouts.app')

@section('content')
<style>
  .people-chip{
    display:inline-flex; align-items:center; gap:.5rem;
    padding:.4rem .8rem; border-radius:999px; background:#f1f6ff; color:#0b5ed7; font-weight:600;
  }
  .person-card{ transition:transform .2s ease, box-shadow .2s ease; }
  .person-card:hover{ transform: translateY(-4px); box-shadow:0 .85rem 1.5rem rgba(0,0,0,.12); }
  /* bingkai foto konsisten 1:1 */
  .person-thumb{
    position:relative; width:100%; padding-top:100%; overflow:hidden; background:#eef2f7;
    border-top-left-radius:.5rem; border-top-right-radius:.5rem;
  }
  .person-thumb img{
    position:absolute; inset:0; width:100%; height:100%; object-fit:cover;
    transition: transform .35s ease;
  }
  .person-card:hover .person-thumb img{ transform: scale(1.05); }
  .tag-soft{ background:rgba(13,110,253,.12); color:#0b5ed7; }
</style>

<section class="container py-5">

  {{-- Header --}}
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h2 class="section-title mb-0 fw-bold">Guru & Tendik</h2>
    <div class="d-flex align-items-center gap-2">
      <span class="people-chip"><i class="bi bi-person-workspace"></i> Guru: {{ $guru->count() }}</span>
      <span class="people-chip"><i class="bi bi-people"></i> Tendik: {{ $tendik->count() }}</span>
    </div>
  </div>
  <p class="text-muted mb-4">SD Negeri Borokulon</p>

  {{-- ====== GURU ====== --}}
  <div class="mt-2">
    <div class="d-flex align-items-center gap-2 mb-2">
      <span class="badge tag-soft text-uppercase">Guru</span>
      <h5 class="fw-bold text-primary mb-0">Daftar Guru</h5>
    </div>

    @if($guru->isEmpty())
      <div class="alert alert-light border d-flex align-items-center" role="alert">
        <i class="bi bi-info-circle text-primary me-2"></i> Belum ada data guru.
      </div>
    @else
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 justify-content-center">
        @foreach($guru as $g)
          @php
            $src = $g->photo ? asset(Str::startsWith($g->photo, ['http://','https://','/']) ? $g->photo : 'storage/'.$g->photo)
                             : asset('assets/images/avatar-guru.png');
          @endphp
          <div class="col">
            <div class="card person-card border-0 shadow-sm h-100 text-center">
              <div class="person-thumb">
                <img src="{{ $src }}" loading="lazy" alt="{{ $g->name }}">
              </div>
              <div class="card-body">
                <div class="fw-semibold">{{ $g->name }}</div>
                <small class="text-muted">{{ $g->subject ?: '—' }}</small>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  {{-- ====== TENDIK ====== --}}
  <div class="mt-5">
    <div class="d-flex align-items-center gap-2 mb-2">
      <span class="badge tag-soft text-uppercase">Tendik</span>
      <h5 class="fw-bold text-primary mb-0">Tenaga Kependidikan</h5>
    </div>

    @if($tendik->isEmpty())
      <div class="alert alert-light border d-flex align-items-center" role="alert">
        <i class="bi bi-info-circle text-primary me-2"></i> Belum ada data tendik.
      </div>
    @else
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 justify-content-center">
        @foreach($tendik as $t)
          @php
            $src = $t->photo ? asset(Str::startsWith($t->photo, ['http://','https://','/']) ? $t->photo : 'storage/'.$t->photo)
                             : asset('assets/images/avatar-tendik.png');
          @endphp
          <div class="col">
            <div class="card person-card border-0 shadow-sm h-100 text-center">
              <div class="person-thumb">
                <img src="{{ $src }}" loading="lazy" alt="{{ $t->name }}">
              </div>
              <div class="card-body">
                <div class="fw-semibold">{{ $t->name }}</div>
                <small class="text-muted">{{ $t->position ?: '—' }}</small>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

</section>
@endsection
