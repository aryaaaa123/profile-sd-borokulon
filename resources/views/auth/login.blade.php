@extends('layouts.auth')

@section('content')
<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="text-center mb-3">
            <h1 class="h4 fw-bold mb-1">Login Admin</h1>
            <div class="text-muted">SD Negeri Borokulon</div>
          </div>

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <form method="POST" action="{{ route('login.attempt') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" value="{{ old('email') }}"
                     class="form-control @error('email') is-invalid @enderror" required autofocus>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
              <label class="form-label">Password</label>
              <input type="password" name="password"
                     class="form-control @error('password') is-invalid @enderror" required>
              @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <button class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right me-1"></i> Masuk</button>
          </form>

          <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="small text-decoration-none">← Kembali ke Beranda</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
