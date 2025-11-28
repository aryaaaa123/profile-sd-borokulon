@extends('layouts.app')

@section('content')
<section class="container py-5">

  {{-- ===== STYLE: artikel rapi + foto lebih kecil ===== --}}
  <style>
    :root{
      --ink:#0f172a; --muted:#64748b; --brand:#0d6efd; --line:#e5e7eb; --soft:#f8fafc;
    }

    /* Header chip */
    .kpi-chip{
      display:inline-flex;gap:.5rem;align-items:center;
      padding:.45rem .85rem;border-radius:999px;
      background:#eef2ff;color:#2563eb;font-weight:700;font-size:.85rem
    }
    .lead-muted{color:var(--muted)}

    /* Foto: lebih rendah, 21:9, max-height 320 */
    .feature{
      border-radius:14px; overflow:hidden; border:1px solid var(--line);
      box-shadow:0 14px 28px rgba(15,23,42,.06);
    }
    .feature .frame{
      position:relative; width:100%; aspect-ratio:21/9;     /* rasio wide tapi rendah */
      max-height:320px;                                     /* batasi tinggi */
      background:#f1f5f9;
    }
    .feature img{
      position:absolute; inset:0; width:100%; height:100%;
      object-fit:cover; object-position:center 45%;
      display:block;
    }
    .feature .cap{
      position:absolute; left:0; right:0; bottom:0; padding:.75rem 1rem;
      color:#fff; font-size:.9rem;
      background:linear-gradient(180deg,transparent 0,rgba(0,0,0,.55) 100%);
    }

    /* Kartu artikel */
    .article{
      background:#fff; border:1px solid var(--line); border-radius:14px;
      box-shadow:0 12px 26px rgba(15,23,42,.06);
    }

    /* Tipografi nyaman dibaca */
    .prose{
      max-width: 58ch;         /* lebar baris nyaman */
      line-height: 1.75;
      color: var(--ink);
    }
    .prose p{ margin:0 0 1rem 0; }
    .prose .lead{ font-size:1.05rem; color:var(--muted) }
    .dropcap:first-letter{
      float:left; font:700 2.6rem/1 "Inter", system-ui, -apple-system, "Segoe UI", Roboto;
      margin:.1rem .55rem 0 0; color:var(--brand);
    }

    /* Blok fakta di kanan */
    .fact{
      border:1px solid var(--line); border-radius:12px; background:#fff;
      padding:.85rem 1rem;
    }
    .fact dt{font-weight:700; color:var(--ink)}
    .fact dd{margin:0; color:var(--muted)}
    .list-check{padding-left:0; list-style:none}
    .list-check li{display:flex; gap:.6rem; align-items:flex-start; margin:.35rem 0; color:var(--muted)}
    .list-check i{color:var(--brand); margin-top:.2rem}

    /* Spasi konsisten antar blok */
    .section-gap{ margin-top:1.25rem; }
    .twodc{
      float:left;
      display:inline-block;
      font-weight:800;
      font-size:3rem;     /* ubah bila ingin lebih kecil/besar */
      line-height:1;
      margin:.15rem .6rem 0 0;
      color:var(--brand);
      letter-spacing:.02em;
    }
  </style>

  {{-- ===== Header ringkas ===== --}}
  <div class="mb-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div>
        <h2 class="fw-bold mb-1">Sejarah Sekolah</h2>
        <p class="lead lead-muted mb-0">
          Kisah lahirnya SD Negeri Borokulon—dari swadaya warga hingga menjadi sekolah berakreditasi A.
        </p>
      </div>
      <div class="text-lg-end">
        <span class="kpi-chip me-2"><i class="bi bi-mortarboard-fill"></i> Akreditasi A</span>
        <span class="kpi-chip"><i class="bi bi-calendar2-week"></i> Sejak 1985</span>
      </div>
    </div>
  </div>

  {{-- ===== Foto (lebih kecil) ===== --}}
  <figure class="feature mb-4">
    <div class="frame">
      <img src="{{ asset('assets/images/sejarah.jpeg') }}"
           onerror="this.src='{{ asset('assets/images/background.jpg') }}'"
           alt="Dokumentasi lama kegiatan sekolah">
      <figcaption class="cap">
        Dokumentasi lama kegiatan sekolah yang merekam semangat belajar dan kebersamaan.
      </figcaption>
    </div>
  </figure>

  {{-- ===== Artikel rapi: teks kiri (prose), fakta kanan ===== --}}
  <article class="article p-4 p-lg-5">
    <div class="row g-5 align-items-start">
      {{-- Teks utama --}}
      <div class="col-lg-12">
        <div class="fullprose">
          <p class="">
           <span class="twodc">SD</span> Negeri Borokulon berdiri pada tahun <strong>1985</strong> dari gagasan dan swadaya
            masyarakat yang menginginkan akses pendidikan dasar bermutu di wilayah Banyuurip, Purworejo.
            Dengan sarana yang sederhana, sekolah mulai beroperasi dan menjadi ruang belajar yang
            menumbuhkan karakter, disiplin, serta kecintaan pada ilmu.
          </p>
          <p>
            Bertahun-tahun kemudian, dukungan pemerintah, komite, dan orang tua memperkuat fasilitas
            pembelajaran, program literasi, serta budaya positif sekolah. Prinsip “sekolah ramah anak”
            diterapkan dalam keseharian: pembelajaran aktif, pembiasaan baik, serta keteladanan yang
            menyenangkan.
          </p>
          <p>
            Peningkatan kompetensi guru, penataan kurikulum, serta kolaborasi dengan berbagai pihak
            menghasilkan layanan belajar yang utuh kognitif, afektif, dan psikomotorik. Upaya ini
            mengantarkan sekolah meraih <strong>Akreditasi A</strong> dan meneguhkan komitmen pada
            pendidikan yang inklusif, aman, dan berkualitas.
          </p>
          <div class="section-gap">
            <h5 class="fw-bold mb-2">Nilai yang Terus Dijaga</h5>
            <ul class="list-check">
              <li><i class="bi bi-check-circle-fill"></i> Pembelajaran aktif, menyenangkan, berpusat pada siswa.</li>
              <li><i class="bi bi-check-circle-fill"></i> Lingkungan aman, bersih, dan menumbuhkan kepedulian.</li>
              <li><i class="bi bi-check-circle-fill"></i> Sinergi sekolah orang tua dan masyarakat.</li>
              <li><i class="bi bi-check-circle-fill"></i> Penguatan karakter dan budaya literasi.</li>
            </ul>
          </div>
        </div>
      </div>

      {{-- Kolom fakta ringkas --}}

    </div>
  </article>

</section>
@endsection
