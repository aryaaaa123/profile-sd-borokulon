@extends('layouts.app')

@section('content')
<style>
  /* aksen halus di header & kartu */
  .soft-bg{ background:linear-gradient(180deg, rgba(13,110,253,.08), rgba(13,110,253,0)); }
  .info-chip{
    display:inline-flex; align-items:center; gap:.5rem;
    padding:.5rem .75rem; border-radius:999px; background:#f1f6ff; color:#0b5ed7; font-weight:600;
  }
  .icon-pill{
    width:40px;height:40px; display:inline-flex; align-items:center; justify-content:center;
    border-radius:999px; background:#eef3ff; color:#0b5ed7;
  }
  .stat{
    border-radius:1rem; background:#fff; box-shadow:0 .5rem 1.25rem rgba(16,24,40,.06);
  }
  .stat .num{ font-size:1.6rem; font-weight:800; letter-spacing:.2px; }
  .list-clean li{ padding:.5rem 0; border-bottom:1px dashed #e9edf3; }
  .list-clean li:last-child{ border-bottom:0; }
  .ratio-21x9{ --bs-aspect-ratio: 42.857%; }
</style>

<section class="container py-5">
  {{-- Header --}}
  <div class="soft-bg rounded-4 p-4 p-lg-5 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
      <div>
        <span class="info-chip mb-2">
          <i class="bi bi-mortarboard"></i> SD Negeri Borokulon
        </span>
        <h1 class="h3 h-lg2 fw-bold mb-1">Identitas Sekolah</h1>
        <p class="text-muted mb-0">Profil ringkas, akreditasi, serta informasi kontak resmi sekolah.</p>
      </div>
      <div class="d-flex gap-2">

        <a href="{{ url('/hubungi-kami') }}" class="btn btn-primary rounded-pill">
          <i class="bi bi-chat-dots me-1"></i> Hubungi Kami
        </a>
      </div>
    </div>
  </div>

  <div class="row g-4">
    {{-- Kolom kiri: data + statistik --}}
    <div class="col-lg-7">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
          <div class="d-flex align-items-center gap-2 mb-3">
            <span class="icon-pill"><i class="bi bi-card-list"></i></span>
            <h2 class="h5 fw-bold mb-0">Data Utama</h2>
          </div>

          {{-- grid identitas dengan ikon --}}
          <div class="row g-3">
            <div class="col-sm-6">
              <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-white h-100">
                <i class="bi bi-buildings text-primary fs-4"></i>
                <div>
                  <div class="text-muted small">Nama Sekolah</div>
                  <div class="fw-semibold">SD Negeri Borokulon</div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-white h-100">
                <i class="bi bi-hash text-primary fs-4"></i>
                <div>
                  <div class="text-muted small">NPSN</div>
                  <div class="fw-semibold">20338803</div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-white h-100">
                <i class="bi bi-patch-check-fill text-primary fs-4"></i>
                <div>
                  <div class="text-muted small">Akreditasi</div>
                  <div class="fw-semibold">A</div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-white h-100">
                <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                <div>
                  <div class="text-muted small">Alamat</div>
                  <div class="fw-semibold">Rw. III, Boro Kulon, Kec. Banyuurip, Kabupaten Purworejo, Jawa Tengah 54171</div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-white h-100">
                <i class="bi bi-envelope-open text-primary fs-4"></i>
                <div>
                  <div class="text-muted small">Email</div>
                 <div class="fw-semibold " style="font-size: 0.9em">2borokulon@gmail.com</div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-white h-100">
                <i class="bi bi-telephone text-primary fs-4"></i>
                <div>
                  <div class="text-muted small">Telepon</div>
                  <div class="fw-semibold">(0275) 325618</div>
                </div>
              </div>
            </div>
          </div>

          {{-- statistik singkat --}}
          <div class="row g-3 mt-3">
            <div class="col-6 col-md-4">
              <div class="stat p-3 text-center">
                <div class="num text-primary">A</div>
                <div class="small text-muted">Akreditasi</div>
              </div>
            </div>
            <div class="col-6 col-md-4">
              <div class="stat p-3 text-center">
                <div class="num">1985</div>
                <div class="small text-muted">Sejak</div>
              </div>
            </div>
            <div class="col-6 col-md-4">
              <div class="stat p-3 text-center">
                <div class="num">SD</div>
                <div class="small text-muted">Jenjang</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- Kolom kanan: foto + profil singkat + lokasi --}}
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="ratio ratio-21x9">
          <img src="{{ asset('assets/images/background2.jpeg') }}" class="w-100 h-100 object-fit-cover" alt="SDN Borokulon">
        </div>
        <div class="card-body p-4">
          <div class="d-flex align-items-center gap-2 mb-2">
            <span class="icon-pill"><i class="bi bi-info-circle"></i></span>
            <h3 class="h6 fw-bold mb-0">Profil Singkat</h3>
          </div>
          <div class="text-muted">
            <p class="mb-2">
              SD Negeri Borokulon merupakan sekolah dasar negeri di bawah naungan
              Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi. Beralamat di
              Jl. Giri Mulyo, Borokulon, Banyuurip, Purworejo – Jawa Tengah.
            </p>

          </div>

          {{-- Lokasi mini + CTA --}}
          <div class="mt-3">
            <ul class="list-unstyled list-clean small text-muted">
              <li><i class="bi bi-geo-alt me-2 text-primary"></i> Borokulon, Banyuurip, Purworejo – Jawa Tengah</li>
              <li><i class="bi bi-clock me-2 text-primary"></i> Jam Layanan: Senin–Jumat 07.00–13.00</li>
            </ul>
            <div class="d-flex gap-2">
              <a href="https://www.google.com/maps/search/?api=1&query=SD+Negeri+Borokulon" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill">
                <i class="bi bi-map me-1"></i> Lihat Peta
              </a>
              <a href="{{ url('/hubungi-kami') }}" class="btn btn-primary btn-sm rounded-pill">
                <i class="bi bi-chat-left-text me-1"></i> Hubungi Sekolah
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection
