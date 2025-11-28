<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'SD Negeri Borokulon' }}</title>

  {{-- Favicon / App Icons --}}
<link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}"> {{-- opsional --}}
<meta name="theme-color" content="#0d6efd">

  {{-- Bootstrap & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    /* ===============================
       Root & Global
    ================================*/
    :root{
      /* Tinggi navbar (desktop & mobile) untuk patokan announce sticky */
      --nav-h: 64px;
    }
    @media (max-width: 991.98px){
      :root{ --nav-h: 56px; }
    }

    html, body { height: 100%; }
    body { background:#f8f9fa; }

    /* ===============================
       Z-INDEX LAYERING (agar tidak saling menutup)
       Urutan: dropdown (1090) > navbar (1080) > announce (1030)
    ================================*/
    .navbar.sticky-top{ z-index:1080; }
    .navbar .dropdown-menu{ z-index:1090; }

    /* Announce akan sticky tepat di bawah navbar */
    .announce{
      position: sticky;
      top: var(--nav-h);
      z-index:1030;
    }

    /* ===============================
       HERO (background dari sini)
    ================================*/
    .hero{
      position: relative;
      background: url('{{ asset('assets/images/background.jpg') }}') center/cover no-repeat fixed;
      min-height: 70vh;
      display:flex; align-items:center;
    }
    .hero::before{
      content:""; position:absolute; inset:0;
      background: linear-gradient(180deg, rgba(0,0,0,.45), rgba(0,0,0,.25));
    }
    .hero .hero-content{
      position:relative; z-index:2;
      backdrop-filter: blur(6px);
      background: rgba(255,255,255,.18);
      border: 1px solid rgba(255,255,255,.35);
      box-shadow: 0 10px 30px rgba(0,0,0,.15);
    }

    /* ===============================
       Section Title
    ================================*/
    .section-title{ position:relative; display:inline-block; padding-bottom:.4rem; }
    .section-title::after{
      content:""; position:absolute; left:0; bottom:0;
      width:60%; height:3px; background:#0d6efd; border-radius:2px;
    }

    /* ===============================
       Card Hover
    ================================*/
    .card-zoom{ transition: transform .25s ease, box-shadow .25s ease;}
    .card-zoom:hover{ transform: translateY(-6px); box-shadow:0 1rem 2rem rgba(0,0,0,.15); }

    /* ===============================
       Frame gambar konsisten 16:9
    ================================*/
    .thumb-16x9{ position:relative; width:100%; padding-top:56.25%; overflow:hidden; background:#f2f5f9; }
    .thumb-16x9 > img{ position:absolute; inset:0; width:100%; height:100%; object-fit:cover; transition:transform .35s ease; }
    .card-zoom:hover .thumb-16x9 > img{ transform:scale(1.06); }

    .badge-soft{ background:rgba(13,110,253,.12); color:#0b5ed7; }

    /* ===============================
       Marquee lama (jika masih dipakai di tempat lain)
    ================================*/
    .marquee{ white-space:nowrap; overflow:hidden; }
    .marquee span{ display:inline-block; padding-left:100%; animation:marquee 20s linear infinite; }
    @keyframes marquee{ 0%{transform:translateX(0)} 100%{transform:translateX(-100%)} }
  </style>
</head>
<body>

  {{-- NAVBAR --}}
  @include('partials.navbar')

  {{-- ANNOUNCEMENT BAR (muncul jika $announcements ada) --}}
  @isset($announcements)
    @include('partials.announcement-bar', ['items' => $announcements])
  @endisset

  {{-- MAIN CONTENT --}}
  <main class="min-vh-100">
    @yield('content')
  </main>

  {{-- FOOTER --}}
  @include('partials.footer')

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Penyesuaian otomatis jika tinggi navbar berubah (mis. karena wrap) --}}
  <script>
    (function(){
      const nav = document.querySelector('.navbar.sticky-top');
      const ann = document.querySelector('.announce');
      if(!nav || !ann) return;
      const syncTop = () => { ann.style.top = nav.offsetHeight + 'px'; };
      syncTop(); window.addEventListener('resize', syncTop);
    })();
  </script>
</body>
</html>
