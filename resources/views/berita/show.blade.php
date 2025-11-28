@extends('layouts.app')

@section('content')
<style>
  .thumb-16x9{ position:relative; width:100%; padding-top:56.25%; overflow:hidden; background:#f2f5f9; }
  .thumb-16x9 > img{ position:absolute; inset:0; width:100%; height:100%; object-fit:cover; }
  .article-content{ font-size:1.05rem; line-height:1.85; color:#334155; }
  .article-content h2, .article-content h3, .article-content h4{ margin-top:1.4rem; margin-bottom:.6rem; }
  .article-content img{ max-width:100%; height:auto; border-radius:.5rem; }
  .article-content blockquote{
    margin:1rem 0; padding:1rem 1.25rem; border-left:4px solid #0d6efd; background:#f8fbff; border-radius:.5rem;
  }
  .meta-chip{ background:rgba(13,110,253,.1); color:#0b5ed7; }
  .share a{ width:36px; height:36px; display:flex; align-items:center; justify-content:center; border-radius:999px; }
  .sticky-aside{ position:sticky; top:100px; }
  .truncate-2{ display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
</style>

<section class="container py-4 py-md-5">
  <div class="row g-4">

    {{-- KONTEN ARTIKEL --}}
    <div class="col-lg-8">
      {{-- Breadcrumb sederhana --}}
      <nav class="small mb-2" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($post->title, 50) }}</li>
        </ol>
      </nav>

      <article class="card border-0 shadow-sm rounded-4">
        {{-- Gambar hero konsisten 16:9 --}}
        @if($post->cover)
          <div class="thumb-16x9 rounded-top-4">
            <img src="{{ asset('storage/'.$post->cover) }}" alt="{{ $post->title }}">
          </div>
        @endif

        <div class="card-body p-4 p-md-5">
          {{-- Kategori + Judul --}}
          <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
            @if($post->category)
              <span class="badge meta-chip">{{ $post->category }}</span>
            @endif
          </div>

          <h1 class="h3 fw-bold mb-2">{{ $post->title }}</h1>

          {{-- Meta: tanggal, author, estimasi baca --}}
          @php
            $plain = trim(strip_tags($post->content ?? ''));
            $wordCount = str_word_count($plain);
            $readMin = max(1, ceil($wordCount / 180)); // rata-rata 180 kata/menit
          @endphp
          <div class="text-muted small mb-3">
            <i class="bi bi-calendar3 me-1"></i>{{ optional($post->published_at)->format('d M Y') }}
            @if($post->author) &middot; <i class="bi bi-person me-1"></i>{{ $post->author }} @endif
            &middot; <i class="bi bi-clock me-1"></i>{{ $readMin }} menit baca
          </div>

          {{-- Konten --}}
          <div class="article-content content">
            {!! $post->content !!} {{-- izinkan HTML dari editor --}}
          </div>

          {{-- Bagikan --}}
          @php
            $shareUrl = urlencode(request()->fullUrl());
            $shareText = urlencode($post->title.' - SD Negeri Borokulon');
          @endphp
          <div class="mt-4 d-flex align-items-center gap-2 share">
            <span class="text-muted small me-1">Bagikan:</span>
            <a class="btn btn-outline-secondary btn-sm" target="_blank"
               href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" aria-label="Facebook">
              <i class="bi bi-facebook"></i>
            </a>
            <a class="btn btn-outline-secondary btn-sm" target="_blank"
               href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}" aria-label="X/Twitter">
              <i class="bi bi-twitter-x"></i>
            </a>
            <a class="btn btn-outline-secondary btn-sm" target="_blank"
               href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}" aria-label="WhatsApp">
              <i class="bi bi-whatsapp"></i>
            </a>
            <button class="btn btn-outline-secondary btn-sm" type="button" onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}')">
              <i class="bi bi-link-45deg"></i>
            </button>
          </div>

          {{-- Prev / Next (opsional) --}}
          @if(isset($prev) || isset($next))
          <hr class="my-4">
          <div class="d-flex justify-content-between gap-2">
            <div class="text-start">
              @isset($prev)
                <a href="{{ route('berita.show',$prev->slug) }}" class="btn btn-light btn-sm">
                  <i class="bi bi-arrow-left me-1"></i> {{ \Illuminate\Support\Str::limit($prev->title, 36) }}
                </a>
              @endisset
            </div>
            <div class="text-end">
              @isset($next)
                <a href="{{ route('berita.show',$next->slug) }}" class="btn btn-light btn-sm">
                  {{ \Illuminate\Support\Str::limit($next->title, 36) }} <i class="bi bi-arrow-right ms-1"></i>
                </a>
              @endisset
            </div>
          </div>
          @endif

        </div>
      </article>
    </div>

    {{-- SIDEBAR BERITA TERKAIT --}}
    <div class="col-lg-4">
      <aside class="sticky-aside">
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-body">
            <h6 class="fw-bold text-primary mb-3">Berita Terkait</h6>

            @forelse($related as $r)
              @php
                $relatedCover = $r->cover ? asset('storage/'.$r->cover) : asset('assets/images/placeholder-4x3.jpg');
              @endphp
              <div class="d-flex mb-3">
                <div class="rounded me-2 overflow-hidden" style="width:96px;height:72px;background:#f2f5f9;">
                  <img src="{{ $relatedCover }}" class="w-100 h-100" style="object-fit:cover" alt="{{ $r->title }}">
                </div>
                <div class="flex-grow-1">
                  <a class="text-dark text-decoration-none fw-semibold d-block truncate-2"
                     href="{{ route('berita.show',$r->slug) }}">
                    {{ $r->title }}
                  </a>
                  <div class="small text-muted">
                    {{ optional($r->published_at)->format('d M Y') }}
                  </div>
                </div>
              </div>
            @empty
              <div class="text-muted small">Belum ada berita terkait.</div>
            @endforelse
          </div>
        </div>
      </aside>
    </div>

  </div>
</section>
@endsection
