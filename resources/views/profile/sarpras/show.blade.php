@extends('layouts.app')

@section('content')
    <style>
        .thumb-16x9 {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            overflow: hidden;
            background: #f2f5f9;
        }

        .thumb-16x9>img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-content {
            font-size: 1.05rem;
            line-height: 1.85;
            color: #334155;
        }

        .article-content h2,
        .article-content h3,
        .article-content h4 {
            margin-top: 1.4rem;
            margin-bottom: .6rem;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: .5rem;
        }

        .article-content p {
            margin-bottom: 1rem;
        }

        .meta-chip {
            background: rgba(13, 110, 253, .1);
            color: #0b5ed7;
        }

        .share a {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
        }

        .sticky-aside {
            position: sticky;
            top: 100px;
        }

        .truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <section class="container py-4 py-md-5">
        <div class="row g-4">

            {{-- KONTEN DETAIL SARPRAS --}}
            <div class="col-lg-8">
                {{-- Breadcrumb sederhana --}}
                <nav class="small mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profile.sarpras') }}">Sarana & Prasarana</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ \Illuminate\Support\Str::limit($sarpras->title, 50) }}</li>
                    </ol>
                </nav>

                <article class="card border-0 shadow-sm rounded-4">
                    {{-- Gambar hero konsisten 16:9 --}}
                    @if ($sarpras->image)
                        <div class="thumb-16x9 rounded-top-4">
                            <img src="{{ asset('storage/' . $sarpras->image) }}" alt="{{ $sarpras->title }}">
                        </div>
                    @endif

                    <div class="card-body p-4 p-md-5">
                        {{-- Judul dengan Icon --}}
                        <h1 class="h3 fw-bold mb-3">
                            @if ($sarpras->icon)
                                <i class="bi {{ $sarpras->icon }} text-primary me-2"></i>
                            @endif
                            {{ $sarpras->title }}
                        </h1>

                        {{-- Meta: badges untuk kategori, kondisi, jumlah --}}
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @if ($sarpras->category ?? false)
                                <span class="badge meta-chip">
                                    <i class="bi bi-grid me-1"></i>{{ $sarpras->category }}
                                </span>
                            @endif
                            @if ($sarpras->condition ?? false)
                                <span class="badge bg-success-subtle text-success">
                                    <i class="bi bi-activity me-1"></i>Kondisi: {{ $sarpras->condition }}
                                </span>
                            @endif
                            @if ($sarpras->quantity ?? false)
                                <span class="badge bg-secondary-subtle text-secondary">
                                    <i class="bi bi-123 me-1"></i>Jumlah: {{ $sarpras->quantity }}
                                </span>
                            @endif
                        </div>

                        {{-- Deskripsi/Konten --}}
                        @if ($sarpras->description)
                            <div class="article-content">
                                {!! nl2br(e($sarpras->description)) !!}
                            </div>
                        @else
                            <div class="text-muted">Tidak ada deskripsi tersedia.</div>
                        @endif

                        {{-- Bagikan --}}
                        @php
                            $shareUrl = urlencode(request()->fullUrl());
                            $shareText = urlencode($sarpras->title . ' - SD Negeri Borokulon');
                        @endphp
                        <div class="mt-4 d-flex align-items-center gap-2 share">
                            <span class="text-muted small me-1">Bagikan:</span>
                            <a class="btn btn-outline-secondary btn-sm" target="_blank"
                                href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                                aria-label="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a class="btn btn-outline-secondary btn-sm" target="_blank"
                                href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
                                aria-label="X/Twitter">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a class="btn btn-outline-secondary btn-sm" target="_blank"
                                href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}"
                                aria-label="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <button class="btn btn-outline-secondary btn-sm" type="button"
                                onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}'); alert('Link disalin!')">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>

                        {{-- Kembali ke daftar --}}
                        <hr class="my-4">
                        <div class="text-start">
                            <a href="{{ route('profile.sarpras') }}" class="btn btn-light btn-sm">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Sarpras
                            </a>
                        </div>

                    </div>
                </article>
            </div>

            {{-- SIDEBAR SARPRAS TERKAIT --}}
            <div class="col-lg-4">
                <aside class="sticky-aside">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary mb-3">Sarana & Prasarana Lainnya</h6>

                            @forelse($related as $r)
                                @php
                                    $relatedImg = $r->image
                                        ? asset('storage/' . $r->image)
                                        : asset('assets/images/placeholder-4x3.jpg');
                                @endphp
                                <div class="d-flex mb-3">
                                    <div class="rounded me-2 overflow-hidden"
                                        style="width:96px;height:72px;background:#f2f5f9;">
                                        <img src="{{ $relatedImg }}" class="w-100 h-100" style="object-fit:cover"
                                            alt="{{ $r->title }}">
                                    </div>
                                    <div class="flex-grow-1">
                                        <a class="text-dark text-decoration-none fw-semibold d-block truncate-2"
                                            href="{{ route('profile.sarpras.show', $r->slug) }}">
                                            @if ($r->icon)
                                                <i class="bi {{ $r->icon }} text-primary me-1"></i>
                                            @endif
                                            {{ $r->title }}
                                        </a>
                                        @if ($r->category ?? false)
                                            <div class="small text-muted mt-1">
                                                <i class="bi bi-grid"></i> {{ $r->category }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted small">Belum ada sarpras lainnya.</div>
                            @endforelse
                        </div>
                    </div>
                </aside>
            </div>

        </div>
    </section>
@endsection
