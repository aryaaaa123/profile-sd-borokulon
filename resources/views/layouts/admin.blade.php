<!doctype html>
<html lang="id" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ $title ?? 'Admin — SD Negeri Borokulon' }}</title>

  {{-- Bootstrap & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Custom Styles --}}
  <style>
    :root{
      --ink:#0f172a; --muted:#64748b; --line:#e5e7eb; --soft:#f8fafc; --brand:#0d6efd; --card:#ffffff;
    }
    [data-theme="dark"]{
      --ink:#e5e7eb; --muted:#9aa4b2; --line:#263041; --soft:#0b1220; --brand:#4c8dff; --card:#0e172a;
      color-scheme: dark;
    }
    html, body { height: 100%; }
    body { background: var(--soft); color: var(--ink); }

    /* Layout */
    .admin-wrap{ min-height:100dvh; display:flex; }
    .sidebar{
      width:260px; flex:0 0 260px; background:#fff; border-right:1px solid var(--line);
      position:sticky; top:0; height:100dvh; padding:1rem .75rem; overflow-y:auto; background:var(--card);
    }
    [data-theme="dark"] .sidebar{ background:var(--card); }
    .content-area{ flex:1 1 auto; min-width:0; }

    .topbar{
      position:sticky; top:0; z-index:1030;
      backdrop-filter: blur(8px);
      border-bottom:1px solid var(--line);
      background:rgba(255,255,255,.6);
    }
    [data-theme="dark"] .topbar{ background:rgba(5,10,20,.6); }

    .nav-section{ font-size:.75rem; color:var(--muted); padding:.75rem 1rem .25rem; text-transform:uppercase; letter-spacing:.04em; }
    .snav .nav-link{
      display:flex; align-items:center; gap:.6rem; padding:.55rem .8rem; border-radius:.6rem; color:var(--ink);
    }
    .snav .nav-link i{ width:1.25rem; text-align:center; color:var(--muted); }
    .snav .nav-link:hover{ background:rgba(13,110,253,.08); color:#0d6efd; }
    .snav .nav-link.active{
      background:rgba(13,110,253,.12); color:#0d6efd; font-weight:600;
      border:1px solid rgba(13,110,253,.24);
    }

    .brand{
      padding:.25rem .75rem; display:flex; align-items:center; gap:.5rem; font-weight:800; color:var(--ink);
    }
    .brand i{ color:#0d6efd; }

    .card-soft{ background:var(--card); border:1px solid var(--line); }
    .footer-muted{ color:var(--muted); font-size:.85rem; }

    /* Mobile */
    @media (max-width: 991.98px){
      .sidebar{ position:fixed; left:0; top:0; height:100%; z-index:1045; transform:translateX(-100%); transition:transform .25s ease; }
      .sidebar.show{ transform:translateX(0); }
      .backdrop{ position:fixed; inset:0; background:rgba(0,0,0,.35); z-index:1040; display:none; }
      .backdrop.show{ display:block; }
    }
  </style>

  @stack('styles')
</head>
<body>

<div class="admin-wrap">
  {{-- SIDEBAR --}}
  <aside id="sidebar" class="sidebar">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <a href="{{ route('admin.dashboard') }}" class="brand text-decoration-none">
        <i class="bi bi-mortarboard-fill fs-4"></i> <span>Admin SDN Borokulon</span>
      </a>
      <button class="btn btn-sm btn-outline-secondary d-lg-none" id="btnCloseSidebar" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
    </div>

    <nav class="snav">
      <div class="nav-section">Utama</div>
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>

      <div class="nav-section">Konten</div>
      <a class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
        <i class="bi bi-newspaper"></i> Berita
      </a>
      <a class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}">
        <i class="bi bi-images"></i> Galeri
      </a>
      <a class="nav-link {{ request()->routeIs('admin.sarpras.*') ? 'active' : '' }}" href="{{ route('admin.sarpras.index') }}">
        <i class="bi bi-building"></i> Sarpras
      </a>
      <a class="nav-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}" href="{{ route('admin.staff.index') }}">
        <i class="bi bi-people"></i> Guru & Tendik
      </a>
      <a class="nav-link {{ request()->routeIs('admin.ann.*') ? 'active' : '' }}" href="{{ route('admin.ann.index') }}">
        <i class="bi bi-bell"></i> Pengumuman
      </a>
      <a class="nav-link {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}" href="{{ route('admin.contact.index') }}">
        <i class="bi bi-inbox"></i> Pesan Masuk
      </a>

      {{-- Bisa tambahkan menu lain di sini --}}
    </nav>

    <hr>

    <div class="p-2">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
      </form>
    </div>
  </aside>

  {{-- BACKDROP mobile --}}
  <div id="backdrop" class="backdrop d-lg-none"></div>

  {{-- AREA KONTEN --}}
  <div class="content-area d-flex flex-column w-100">
    {{-- TOPBAR --}}
    <nav class="topbar py-2 px-3 px-lg-4 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-outline-secondary d-lg-none" id="btnOpenSidebar" aria-label="Menu">
          <i class="bi bi-list"></i>
        </button>
        <div class="input-group d-none d-md-flex">
          <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-search text-secondary"></i></span>
          <input type="search" class="form-control border-start-0" placeholder="Cari di admin…">
        </div>
      </div>

      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-outline-secondary" id="btnTheme" title="Toggle tema">
          <i class="bi bi-moon-stars"></i>
        </button>
        {{-- Profil mini (opsional) --}}
        <div class="dropdown">
          <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i> Admin
          </button>
          <div class="dropdown-menu dropdown-menu-end p-2 card-soft">
            <div class="px-2 py-1 small text-muted">Masuk sebagai</div>
            <div class="px-2 pb-2 fw-semibold">Admin SDN Borokulon</div>
            <form action="{{ route('logout') }}" method="POST" class="px-2">
              @csrf
              <button class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
          </div>
        </div>
      </div>
    </nav>

    {{-- MAIN --}}
    <main class="flex-grow-1 p-3 p-lg-4">
      @if(session('success'))
        <div class="alert alert-success card-soft">{{ session('success') }}</div>
      @endif

      @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="border-top py-3 px-3 px-lg-4">
      <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div class="footer-muted">© {{ date('Y') }} SD Negeri Borokulon — Admin Panel</div>
        <div class="footer-muted">Bootstrap 5 • Made with ♥</div>
      </div>
    </footer>
  </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Sidebar mobile
  const sidebar = document.getElementById('sidebar');
  const backdrop = document.getElementById('backdrop');
  const btnOpenSidebar = document.getElementById('btnOpenSidebar');
  const btnCloseSidebar = document.getElementById('btnCloseSidebar');

  function openSidebar(){ sidebar.classList.add('show'); backdrop.classList.add('show'); }
  function closeSidebar(){ sidebar.classList.remove('show'); backdrop.classList.remove('show'); }

  btnOpenSidebar && btnOpenSidebar.addEventListener('click', openSidebar);
  btnCloseSidebar && btnCloseSidebar.addEventListener('click', closeSidebar);
  backdrop && backdrop.addEventListener('click', closeSidebar);

  // Theme toggle (persist di localStorage)
  const root = document.documentElement;
  const btnTheme = document.getElementById('btnTheme');
  const THEME_KEY = 'admin-theme';
  const saved = localStorage.getItem(THEME_KEY);
  if(saved){ root.setAttribute('data-theme', saved); }

  function toggleTheme(){
    const cur = root.getAttribute('data-theme') || 'light';
    const next = cur === 'dark' ? 'light' : 'dark';
    root.setAttribute('data-theme', next);
    localStorage.setItem(THEME_KEY, next);
  }
  btnTheme && btnTheme.addEventListener('click', toggleTheme);
</script>

@stack('scripts')
</body>
</html>
