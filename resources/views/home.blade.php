@extends('layouts.app')

@section('content')
<style>
  .brand-logo{
    height: 36px;              /* ubah ke 40px jika ingin sedikit lebih besar */
    width: auto;               /* jaga rasio */
    object-fit: contain;       /* hindari distorsi */
    display: block;
  }

</style>

    {{-- HERO --}}
    <header class="hero">
        <div class="container py-5">
            <div class="hero-content rounded-4 p-4 p-md-5 text-white col-12 col-lg-8">
                <span class="badge bg-light text-dark mb-3"><i class="bi bi-mortarboard-fill me-1"></i> SD Negeri
                    Borokulon</span>
                <h1 class="display-5 fw-bold mb-2">Selamat Datang di SD Negeri Borokulon</h1>
                <p class="lead mb-4">
                    Sekolah dasar unggulan yang menumbuhkan <em>karakter</em>, <em>literasi</em>, dan <em>prestasi</em>.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ url('/profil/identitas') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-info-circle me-1"></i> Tentang Sekolah
                    </a>
                    <a href="{{ url('/berita') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-newspaper me-1"></i> Berita Terbaru
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Highlight kecil --}}
    <section class="container py-4">
        <div class="row g-3 g-md-4">
            @php $quick = [['bi-people-fill', 'Lingkungan Nyaman'], ['bi-book-half', 'Pembelajaran Aktif'], ['bi-award-fill', 'Prestasi Siswa'], ['bi-shield-check', 'Aman & Terkontrol']]; @endphp
            @foreach ($quick as $q)
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm text-center p-3 card-zoom h-100">
                        <i class="bi {{ $q[0] }} fs-2 text-primary"></i>
                        <div class="mt-2 fw-semibold">{{ $q[1] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Visi & Misi (Misi 1 baris) --}}
    <section class="container py-5">
        <div class="row g-4">
            <div class="col-12">
                <h2 class="section-title">Visi & Misi</h2>
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="fw-bold text-primary mb-2 "><i class="bi bi-stars me-2"></i>Visi</h5>
                        <p class="mb-0">Terwujudnya Sekolah Berprestasi, Santun dan Berwawasan Lingkungan.</p>
                    </div>
                </div>
            </div>

            <div class="col-12">
                @php
                    $misi = [
                        'Mewujudkan peserta didik yang beriman dan bertaqwa kepada Tuhan Yang Maha Esa.',
                        'Membiasakan senyum, salam dan sapa.',
                        'Mewujudkan prestasi akademik maupun non akademik.',
                        'Menanamkan semangat nasionalisme dalam mengembangkan pendidikan berbasis keunggulan lokal dan global.',
                        'Mewujudkan lingkungan sekolah yang sehat, bersih, indah, asri dan aman.',
                        'Mengendalikan pencemaran lingkungan.',
                        'Melestarikan fungsi lingkungan.',
                    ];
                @endphp

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold text-primary mb-3">
                            <i class="bi bi-bullseye me-2"></i>Misi
                        </h5>

                        {{-- daftar misi ke bawah --}}
                        <ul class="list-unstyled m-0 d-grid gap-2">
                            @foreach ($misi as $item)
                                <li class="p-3 bg-white shadow-sm d-flex">
                                    <i class="bi bi-check2-circle text-primary me-3 mt-1"></i>
                                    <span class="fw-medium">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sambutan Kepala Sekolah --}}
    <section class="container pb-5">
        <div class="card border-0 shadow-sm p-4 p-md-5">
            <div class="row align-items-center g-4">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('assets/images/kepsek.jpeg') }}" class="img-fluid rounded-circle shadow"
                        style="width:160px;height:160px;object-fit:cover;" alt="Kepala Sekolah">
                </div>
                <div class="col-md-9">
                    <h5 class="fw-bold text-primary mb-2">Sambutan Kepala Sekolah</h5>
                    <p class="mb-0">


                        Assalamu'alaikum warahmatullahi wabarakatuh.

                        Puji syukur kami panjatkan ke hadirat Allah SWT atas rahmat dan karunia-Nya, sehingga website resmi
                        SD Negeri Borokulon ini dapat hadir sebagai sarana informasi, komunikasi, dan publikasi kegiatan
                        sekolah kepada masyarakat luas.

                        Harapan kami, website ini bisa menjadi jendela digital bagi para orang tua, siswa, alumni, dan
                        seluruh pemangku kepentingan pendidikan untuk mengenal lebih dekat SD Negeri Borokulon, serta
                        mendukung kemajuan pendidikan yang berkualitas, inklusif, dan berbasis teknologi.

                        Wassalamu'alaikum warahmatullahi wabarakatuh.
                    </p>
                    <p class="fw-semibold mt-3 mb-0">— Kepala Sekolah, Ibu [Yennie Damayanti Puspasari, SPd.SD,MPd.]</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Video Profil --}}
    <section class="bg-white py-5 border-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">Video Profil</h4>
                <span class="text-muted small"><i class="bi bi-youtube me-1"></i> YouTube</span>
            </div>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="ratio ratio-16x9 shadow-sm rounded-4 overflow-hidden">
  <iframe
    src="https://www.youtube-nocookie.com/embed/Uj1Nu_PCJ9Y?start=5&rel=0&modestbranding=1"
    title="Video Profil SD Negeri Borokulon"
    loading="lazy"
    referrerpolicy="strict-origin-when-cross-origin"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    allowfullscreen>
  </iframe>
</div>

                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary">Tentang Video</h5>
                            <p class="text-muted">Video profil memperkenalkan fasilitas, budaya belajar, dan kegiatan siswa
                                SD Negeri Borokulon.</p>
                            <a class="btn btn-outline-primary w-100" href="https://www.youtube.com/watch?v=Uj1Nu_PCJ9Y&t=5s"
                                target="_blank">
                                <i class="bi bi-box-arrow-up-right me-1"></i> Tonton di YouTube
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    {{-- Berita Terbaru (hanya 3 item, gambar besar & konsisten) --}}
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="section-title mb-0">Berita Terbaru</h4>
            <a href="{{ url('/berita') }}" class="text-primary text-decoration-none">Lihat Semua</a>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse(($beritaTerbaru ?? collect())->take(3) as $p)
                @php $cover = $p->cover ? asset('storage/'.$p->cover) : asset('assets/images/placeholder-16x9.png'); @endphp
                <div class="col-12 col-md-4 ">
                    <div class="card h-100 shadow-sm border-0 card-zoom">
                        <div class="thumb-16x9">
                            <img src="{{ $cover }}" alt="{{ $p->title }}" loading="lazy">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span
                                    class="badge badge-soft">{{ optional($p->published_at)->format('d M Y') ?? '—' }}</span>
                            </div>
                            <h6 class="card-title mb-2">
                                <a href="{{ url('/berita/' . $p->slug) }}"
                                    class="text-decoration-none text-dark">{{ $p->title }}</a>
                            </h6>
                            <a href="{{ url('/berita/' . $p->slug) }}"
                                class="mt-auto btn btn-sm btn-outline-primary">Baca</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted mb-0">Belum ada berita.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Galeri Terbaru (hanya 3 item, gambar besar & konsisten) --}}
    <section class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="section-title mb-0">Galeri Terbaru</h4>
            <a href="{{ url('/galeri') }}" class="text-primary text-decoration-none">Lihat Semua</a>
        </div>

        <div class="row g-3 g-md-4 justify-content-center">
            @forelse(($galeriTerbaru ?? collect())->take(3) as $g)
                @php $img = $g->image_path ? asset('storage/'.$g->image_path) : asset('assets/images/placeholder-16x9.png'); @endphp
                <div class="col-12 col-md-4">
                    <a href="{{ $img }}" target="_blank"
                        class="d-block rounded-4 overflow-hidden shadow-sm card-zoom">
                        <div class="thumb-16x9">
                            <img src="{{ $img }}" alt="{{ $g->title }}" loading="lazy">
                        </div>
                    </a>
                    <div class="small mt-2 text-truncate" title="{{ $g->title }}">{{ $g->title }}</div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted mb-0">Belum ada foto galeri.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
