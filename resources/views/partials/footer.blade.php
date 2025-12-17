{{-- FOOTER Modern SDN Borokulon --}}
<footer class="footer-dark text-white mt-5 pt-5">
  <div class="container">
    <div class="row gy-4">

      {{-- Brand & Kontak --}}
      <div class="col-12 col-lg-5">
        <div class="d-flex align-items-start gap-2 mb-2">
          <img
    src="{{ asset('assets/images/logo.png') }}"
    alt="Logo SD Negeri Borokulon"
    class="brand-logo"
    width="36" height="36"
    fetchpriority="high">
  <h5 class="fw-bold pt-2">SD Negeri Borokulon</h5>
        </div>
        <p class="mb-3 text-white-50">
          Rw. III, Boro Kulon, Kec. Banyuurip, Kabupaten Purworejo, Jawa Tengah 54171
        </p>

        <ul class="list-unstyled small mb-3">
          <li class="mb-1">
            <i class="bi bi-telephone me-2 text-primary"></i>
            <a class="link-fx" href="tel:+62275325618">(0275) 325618</a>
          </li>
          <li class="mb-1">
            <i class="bi bi-envelope me-2 text-primary"></i>
            <a class="link-fx" href="mailto:2borokulon@gmail.com">2borokulon@gmail.com</a>
          </li>
          <li class="mb-1">
            <i class="bi bi-geo-alt me-2 text-primary"></i>
            <a class="link-fx" target="_blank"
               href="https://www.google.com/maps/search/?api=1&query=SD+Negeri+Borokulon">Lihat di Google Maps</a>
          </li>
        </ul>

        <div class="d-flex gap-2">
          <a class="btn btn-outline-light btn-sm rounded-circle social" aria-label="Facebook" href="#" target="_blank"><i class="bi bi-facebook"></i></a>
          <a class="btn btn-outline-light btn-sm rounded-circle social" aria-label="Instagram" href="#" target="_blank"><i class="bi bi-instagram"></i></a>
          <a class="btn btn-outline-light btn-sm rounded-circle social" aria-label="YouTube" href="#" target="_blank"><i class="bi bi-youtube"></i></a>
        </div>
      </div>

      {{-- Tautan --}}
      <div class="col-6 col-lg-3">
        <h6 class="fw-semibold mb-3">Tautan</h6>
        <ul class="list-unstyled m-0">
          <li class="mb-2"><a class="link-fx" href="{{ url('/berita') }}">Berita</a></li>
          <li class="mb-2"><a class="link-fx" href="{{ url('/galeri') }}">Galeri</a></li>
          <li class="mb-2"><a class="link-fx" href="{{ url('/hubungi-kami') }}">Hubungi Kami</a></li>
          <li class="mb-2"><a class="link-fx" href="{{ url('/profil/identitas') }}">Identitas Sekolah</a></li>
          <li class="mb-2"><a class="link-fx" href="{{ url('/profil/guru-tendik') }}">Guru & Tendik</a></li>
        </ul>
      </div>

      {{-- Info Layanan / Jam --}}
      <div class="col-6 col-lg-4">
        <h6 class="fw-semibold mb-3">Jam Layanan</h6>
        <ul class="list-unstyled small m-0">
          <li class="d-flex justify-content-between border-bottom border-secondary-subtle py-1">
            <span>Senin–Jumat</span><span>07.00–13.00</span>
          </li>

          <li class="d-flex justify-content-between py-1">
            <span>Sabtu/Minggu/Libur</span><span>Tutup</span>
          </li>
        </ul>

        <div class="mt-3">
          <a href="{{ url('/hubungi-kami') }}" class="btn btn-primary btn-sm rounded-pill">
            <i class="bi bi-chat-dots me-1"></i> Kirim Pesan
          </a>
        </div>
      </div>
    </div>

    <div class="text-center border-top border-secondary mt-4 p-2 small text-white-50">
      © {{ date('Y') }} SD Negeri Borokulon. All rights reserved.
    </div>
  </div>

  {{-- Back to Top --}}
  <button id="backToTop" class="btn btn-primary rounded-circle shadow backtop" aria-label="Kembali ke atas">
    <i class="bi bi-arrow-up"></i>
  </button>
</footer>

{{-- Style khusus Footer --}}
<style>
  .footer-dark{
    background: radial-gradient(1200px 400px at 10% -10%, rgba(13,110,253,.2), transparent),
                #0f1220;
  }
  .link-fx{
    color:#e8eefc; text-decoration:none;
    border-bottom:1px solid transparent;
  }
  .link-fx:hover{ color:#fff; border-bottom-color:rgba(255,255,255,.35); }

  .social{ width:36px; height:36px; display:flex; align-items:center; justify-content:center; }
  .social:hover{ color:#0d6efd; background:#fff; border-color:#fff; }

  .backtop{
    position:fixed; right:16px; bottom:16px; width:44px; height:44px;
    display:none; align-items:center; justify-content:center;
  }
</style>

{{-- Script Back to Top --}}
<script>
  (function () {
    const btn = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
      btn.style.display = (window.scrollY > 240) ? 'flex' : 'none';
    });
    btn.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));
  })();
</script>
