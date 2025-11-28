@extends('layouts.app')

@section('content')
<section class="container py-5">

  <style>
    .contact-card{ border-radius: 1rem; overflow:hidden; }
    .contact-head{
      background: linear-gradient(135deg, #0d6efd 0%, #60a5fa 100%);
      color:#fff;
    }
    .form-control:focus, .form-select:focus{
      box-shadow: 0 0 0 .25rem rgba(13,110,253,.12);
      border-color:#86b7fe;
    }
    .helper-text{ font-size:.825rem; color:#6b7280; }
    .char-ok{ color:#198754; }
    .char-warn{ color:#d63384; }
    .contact-info-list i{ width:1.25rem; }
    .btn-send[disabled]{ opacity:.7; cursor:wait; }
  </style>

  <div class="row g-4">
    {{-- =================== FORM =================== --}}
    <div class="col-lg-7">
      <div class="card shadow-sm contact-card border-0">
        <div class="contact-head p-3 p-md-4 d-flex align-items-center gap-3">
          <div class="rounded-circle bg-white bg-opacity-20 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
            <i class="bi bi-chat-left-text fs-5"></i>
          </div>
          <div>
            <h2 class="h4 mb-0">Hubungi Kami</h2>
            <div class="small text-white-50">Kami akan membalas secepatnya pada jam kerja.</div>
          </div>
        </div>

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show m-3 mb-0" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
          </div>
        @endif

        <form action="{{ route('hubungi.store') }}" method="POST" class="p-3 p-md-4" id="contactForm" novalidate>
          @csrf
          {{-- Honeypot (disembunyikan) --}}
          <input type="text" name="hp_field" tabindex="-1" autocomplete="off" aria-hidden="true"
                 style="position:absolute; left:-9999px; opacity:0;">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="name">Nama Lengkap *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label" for="email">Email *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label" for="subject">Subjek</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <input id="subject" type="text" name="subject" value="{{ old('subject') }}"
                       class="form-control @error('subject') is-invalid @enderror" placeholder="Opsional">
                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label" for="phone">No. HP</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                       class="form-control @error('phone') is-invalid @enderror" placeholder="Opsional">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-12">
              <label class="form-label" for="message">Pesan *</label>
              <textarea id="message" name="message" rows="6"
                        class="form-control @error('message') is-invalid @enderror"
                        maxlength="2000" required>{{ old('message') }}</textarea>
              @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
              <div class="d-flex justify-content-between mt-1">
                <small class="helper-text">Harap sampaikan pertanyaan/keperluan dengan jelas.</small>
                <small class="helper-text" id="charCounter">0/2000</small>
              </div>
            </div>
          </div>

          <div class="d-flex align-items-center justify-content-between mt-3">
            <small class="text-muted">Tanda (*) wajib diisi.</small>
            <button class="btn btn-primary btn-send" type="submit">
              <i class="bi bi-send me-1"></i> Kirim Pesan
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- =================== INFO SEKOLAH + MAPS =================== --}}
    <div class="col-lg-5">
      <div class="card shadow-sm border-0 contact-card">
        <div class="contact-head p-3 d-flex align-items-center gap-3">
          <div class="rounded-circle bg-white bg-opacity-20 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
            <i class="bi bi-geo-alt fs-5"></i>
          </div>
          <div>
            <h6 class="mb-0">Informasi Sekolah</h6>
            <div class="small text-white-50">Alamat & kontak resmi</div>
          </div>
        </div>

        <div class="p-3 p-md-4">
          <h5 class="fw-bold text-primary mb-2">SD Negeri Borokulon</h5>
          <ul class="list-unstyled contact-info-list mb-3">
            <li class="mb-1"><i class="bi bi-geo"></i> Rw. III, Boro Kulon, Kec. Banyuurip</li>
            <li class="mb-1"><i class="bi bi-geo"></i> Kabupaten Purworejo, Jawa Tengah</li>
            <li class="mb-1"><i class="bi bi-envelope"></i> info@sdn-borokulon.sch.id</li>
            <li class="mb-1"><i class="bi bi-telephone"></i> (—) ————</li>
          </ul>

          <div class="ratio ratio-4x3 rounded overflow-hidden">
            {{-- Ganti q dengan koordinat/alamat sekolah --}}
            <iframe
              src="https://www.google.com/maps?q=Purworejo&output=embed"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              aria-label="Peta lokasi SD Negeri Borokulon"></iframe>
          </div>

          <div class="d-flex gap-2 mt-4">
            <a class="btn btn-outline-primary btn-sm" target="_blank"
               href="https://maps.google.com/?q=Purworejo">
              <i class="bi bi-pin-map me-1"></i> Lihat di Google Maps
            </a>
            <a class="btn btn-outline-secondary btn-sm" href="mailto:info@sdn-borokulon.sch.id">
              <i class="bi bi-envelope me-1"></i> Email Langsung
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- =================== SCRIPTS =================== --}}
<script>
  // Counter karakter pesan
  (function(){
    const ta = document.getElementById('message');
    const cc = document.getElementById('charCounter');
    if(!ta || !cc) return;

    function update(){
      const len = ta.value.length;
      const max = ta.getAttribute('maxlength') ? parseInt(ta.getAttribute('maxlength')) : 2000;
      cc.textContent = `${len}/${max}`;
      cc.classList.toggle('char-warn', len > max * 0.9);
      cc.classList.toggle('char-ok', len <= max * 0.9);
    }
    ta.addEventListener('input', update);
    update();
  })();

  // Disable tombol saat submit untuk cegah double submit
  (function(){
    const form = document.getElementById('contactForm');
    if(!form) return;
    form.addEventListener('submit', function(){
      const btn = form.querySelector('.btn-send');
      if(btn){
        btn.setAttribute('disabled','disabled');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Mengirim…';
      }
    });
  })();
</script>
@endsection
