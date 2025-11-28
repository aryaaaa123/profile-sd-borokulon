{{-- Navbar Modern SDN Borokulon --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top nav-glass">
  <div class="container">

    {{-- Brand --}}
<a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
  <img
    src="{{ asset('assets/images/logo.png') }}"
    alt="Logo SD Negeri Borokulon"
    class="brand-logo"
    width="36" height="36"
    fetchpriority="high">
  <span class="fw-bold text-primary">SD Negeri Borokulon</span>
</a>


    {{-- Toggler --}}
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Menu --}}
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">

        <li class="nav-item">
          <a class="nav-link px-lg-3 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>

        {{-- Dropdown Profil --}}
        <li class="nav-item dropdown">
          <a class="nav-link px-lg-3 dropdown-toggle {{ request()->is('profil*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
            Profil
          </a>
          <ul class="dropdown-menu border-0 shadow dropdown-menu-hover">
            <li><a class="dropdown-item" href="{{ url('/profil/identitas') }}"><i class="bi bi-building me-2"></i>Identitas Sekolah</a></li>
            <li><a class="dropdown-item" href="{{ url('/profil/guru-tendik') }}"><i class="bi bi-people me-2"></i>Guru &amp; Tendik</a></li>
            <li><a class="dropdown-item" href="{{ url('/profil/sejarah') }}"><i class="bi bi-clock-history me-2"></i>Sejarah</a></li>
            <li><a class="dropdown-item" href="{{ url('/profil/sarpras') }}"><i class="bi bi-grid-3x3-gap me-2"></i>Sarana Prasarana</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link px-lg-3 {{ request()->is('berita*') ? 'active' : '' }}" href="{{ url('/berita') }}">Berita</a>
        </li>

        <li class="nav-item">
          <a class="nav-link px-lg-3 {{ request()->is('galeri*') ? 'active' : '' }}" href="{{ url('/galeri') }}">Galeri</a>
        </li>

        {{-- CTA Hubungi Kami --}}
        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
          <a class="btn btn-primary rounded-pill px-3 {{ request()->is('hubungi-kami') ? 'shadow' : '' }}" href="{{ url('/hubungi-kami') }}">
            <i class="bi bi-envelope-paper me-1"></i> Hubungi Kami
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

{{-- Style khusus navbar --}}
<style>
  .nav-glass{backdrop-filter:saturate(140%) blur(6px);}
.navbar .nav-link{
  position: relative;
  font-weight: 600;
}

/* === Underline animasi pakai ::before agar tidak bentrok caret ::after === */
.navbar .nav-link::before{
  content:"";
  position:absolute;
  left:1rem;
  right:1rem;
  bottom:.15rem;
  height:2px;
  background:#0d6efd;
  transform:scaleX(0);
  transform-origin:left;
  transition:transform .25s ease;
}

.navbar .nav-link:hover::before{ transform:scaleX(1); }
.navbar .nav-link.active{ color:#0d6efd !important; }
.navbar .nav-link.active::before{ transform:scaleX(1); }

/* (opsional) rapikan jarak caret dropdown */
.navbar .dropdown-toggle::after{
  margin-left:.35rem;
}

/* dropdown styling */
.dropdown-menu-hover .dropdown-item{ padding:.55rem .9rem; }
.dropdown-menu-hover .dropdown-item:hover{ background:#f1f5ff; color:#0b5ed7; }

@media (min-width: 992px){
  /* buka dropdown saat hover (desktop) */
  .navbar .dropdown:hover .dropdown-menu{ display:block; margin-top:0; }
}


</style>
