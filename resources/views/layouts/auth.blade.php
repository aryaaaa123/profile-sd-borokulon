<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'SD Negeri Borokulon' }}</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body { background:#f8f9fa; }
    /* running text */
    .marquee{ white-space:nowrap; overflow:hidden; }
    .marquee span{ display:inline-block; padding-left:100%; animation:marquee 20s linear infinite; }
    @keyframes marquee{ 0%{transform:translateX(0)} 100%{transform:translateX(-100%)} }

    /* hero */
    .hero {
      position: relative;
      background: url('/assets/images/background.jpg') center/cover no-repeat fixed;
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

    /* section title underline */
    .section-title{
      position:relative; display:inline-block; padding-bottom:.4rem;
    }
    .section-title::after{
      content:""; position:absolute; left:0; bottom:0;
      width:60%; height:3px; background:#0d6efd; border-radius:2px;
    }

    /* card hover */
    .card-zoom{ transition: transform .25s ease, box-shadow .25s ease;}
    .card-zoom:hover{ transform: translateY(-6px); box-shadow:0 1rem 2rem rgba(0,0,0,.15); }
  </style>
</head>
<body>

  @isset($announcements)
    @include('partials.announcement-bar', ['items' => $announcements])
  @endisset

  <main class="min-vh-100">
    @yield('content')
  </main>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
