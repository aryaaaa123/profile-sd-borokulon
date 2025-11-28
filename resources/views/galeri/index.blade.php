@extends('layouts.app')

@section('content')
<section class="container py-5">

  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h2 class="section-title mb-0">Galeri SD Negeri Borokulon</h2>

    <form class="d-flex" action="{{ route('galeri.index') }}">
      <input type="search" class="form-control me-2" name="q" placeholder="Cari foto…" value="{{ $q }}">
      @if($cat)<input type="hidden" name="category" value="{{ $cat }}">@endif
      <button class="btn btn-primary"><i class="bi bi-search"></i></button>
    </form>
  </div>

  <div class="mt-3 d-flex flex-wrap gap-2 ">
    <a href="{{ route('galeri.index') }}"
       class="btn btn-sm {{ $cat==='' ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
    @foreach($categories as $c)
      <a href="{{ route('galeri.index', array_filter(['q'=>$q,'category'=>$c])) }}"
         class="btn btn-sm {{ $cat===$c ? 'btn-primary' : 'btn-outline-primary' }}">{{ $c }}</a>
    @endforeach
  </div>

  <div class="row g-3 mt-1 justify-content-center">
    @forelse($items as $idx => $g)
      @php
        $src = $g->url
          ?? ($g->image_path ? asset('storage/'.$g->image_path) : asset('assets/images/placeholder-4x3.jpg'));
      @endphp
      <div class="col-6 col-md-4 col-lg-3 ">
        <figure class="card border-0 shadow-sm h-100 overflow-hidden card-zoom">
          <a href="#"
             class="d-block gallery-link"
             data-bs-toggle="modal"
             data-bs-target="#lightboxModal"
             data-index="{{ $idx }}"
             data-title="{{ $g->title }}"
             data-category="{{ $g->category ?? '' }}"
             data-src="{{ $src }}">
            <img src="{{ $src }}" alt="{{ $g->title }}" class="w-100" style="height:190px;object-fit:cover">
          </a>
          <figcaption class="card-body py-2">
            <div class="small fw-semibold text-dark mb-1">{{ $g->title ?: 'Tanpa Judul' }}</div>
            @if(!empty($g->category))
              <span class="badge bg-primary-subtle text-primary">{{ $g->category }}</span>
            @endif
          </figcaption>
        </figure>
      </div>
    @empty
      <div class="col-12"><div class="alert alert-secondary">Belum ada foto.</div></div>
    @endforelse
  </div>

  <div class="mt-4">{{ $items->links() }}</div>
</section>

{{-- ===================== MODAL LIGHTBOX ===================== --}}
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered lightbox-dialog">
    <div class="modal-content border-0 lightbox-content">
      <div class="modal-header py-2 px-3">
        <div class="me-2">
          <h6 class="modal-title mb-0" id="lightboxTitle">Foto</h6>
          <div class="small text-muted" id="lightboxMeta"></div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button type="button" class="btn btn-light btn-sm" id="btnPrev" aria-label="Sebelumnya">←</button>
          <button type="button" class="btn btn-light btn-sm" id="btnNext" aria-label="Berikutnya">→</button>
          <button type="button" class="btn-close ms-1" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
      </div>

      <div class="modal-body p-0 bg-dark lightbox-body">
        <img id="lightboxImg" src="" alt="Preview" class="lightbox-img">
      </div>
    </div>
  </div>
</div>

{{-- ===================== STYLE LIGHTBOX ===================== --}}
<style>
  /* variabel fallback jika JS gagal mendeteksi navbar */
  :root{ --nav-h: 72px; }

  /* Dialog: beri margin-top = tinggi navbar agar tidak tertabrak */
  .lightbox-dialog{
    /* 1100px batas nyaman; 92vw untuk layar kecil */
    max-width: min(1100px, 92vw);
    margin: calc(var(--nav-h) + .75rem) auto .75rem auto; /* jarak dari navbar */
  }

  /* Konten: sudut sedikit bulat agar tidak terlalu besar rasanya */
  .lightbox-content{ border-radius: .75rem; overflow: hidden; }

  /* Area gambar: gunakan sisa tinggi viewport (dikurangi navbar + header modal) */
  .lightbox-body{
    display:flex;
    justify-content:center;
    align-items:center;
    background:#111;
    /* 100vh - nav - header(~56px) - padding cadangan(16px) */
    max-height: calc(100vh - var(--nav-h) - 72px);
    min-height: calc(60vh);         /* jangan terlalu pendek */
    overflow:auto;                  /* bisa scroll bila gambar tinggi */
  }

  /* Gambar: proporsional & tidak melebihi area */
  .lightbox-img{
    width:auto;
    height:auto;
    max-width: 100%;
    max-height: calc(100vh - var(--nav-h) - 100px);
    object-fit: contain;
    display:block;
    margin:auto;
  }

  /* Perkecil padding header supaya tidak boros tinggi */
  #lightboxModal .modal-header{ border-bottom: 0; }

  /* Mobile tweak */
  @media (max-width: 576px){
    .lightbox-dialog{
      max-width: 96vw;
      margin: calc(var(--nav-h) + .5rem) .5rem .5rem .5rem;
    }
    .lightbox-body{
      max-height: calc(100vh - var(--nav-h) - 84px);
    }
    .lightbox-img{
      max-height: calc(100vh - var(--nav-h) - 110px);
    }
  }
</style>

{{-- ===================== SCRIPT LIGHTBOX ===================== --}}
<script>
(function () {
  // Set tinggi navbar ke variabel CSS --nav-h agar modal tidak tertabrak
  function setNavHeightVar(){
    const nav = document.querySelector('.navbar');
    const h = nav ? nav.offsetHeight : 72;
    document.documentElement.style.setProperty('--nav-h', h + 'px');
  }
  setNavHeightVar();
  window.addEventListener('resize', setNavHeightVar);

  const links = Array.from(document.querySelectorAll('.gallery-link'));
  const placeholder = "{{ asset('assets/images/placeholder-4x3.jpg') }}";

  const img   = document.getElementById('lightboxImg');
  const title = document.getElementById('lightboxTitle');
  const meta  = document.getElementById('lightboxMeta');
  const prev  = document.getElementById('btnPrev');
  const next  = document.getElementById('btnNext');

  let current = -1;

  function showAt(i) {
    if (!links.length) return;
    if (i < 0) i = links.length - 1;
    if (i >= links.length) i = 0;
    current = i;

    const el   = links[i];
    const src  = el.dataset.src || placeholder;
    const text = el.dataset.title || 'Foto';
    const cat  = el.dataset.category || '';

    img.onerror = () => { img.src = placeholder; };
    img.src = src;
    title.textContent = text;
    meta.textContent  = cat ? ('Kategori: ' + cat) : '';
  }

  document.getElementById('lightboxModal')
    .addEventListener('show.bs.modal', function (e) {
      const trigger = e.relatedTarget;
      const idx = trigger ? parseInt(trigger.dataset.index || '0', 10) : 0;
      showAt(idx);
    });

  prev.addEventListener('click', () => showAt(current - 1));
  next.addEventListener('click', () => showAt(current + 1));

  document.addEventListener('keydown', (ev) => {
    const opened = document.getElementById('lightboxModal').classList.contains('show');
    if (!opened) return;
    if (ev.key === 'ArrowLeft')  { ev.preventDefault(); prev.click(); }
    if (ev.key === 'ArrowRight') { ev.preventDefault(); next.click(); }
  });
})();
</script>
@endsection
