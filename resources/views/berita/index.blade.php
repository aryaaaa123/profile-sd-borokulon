@extends('layouts.app')

@section('content')
    <style>
        .truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .truncate-3 {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .badge-soft {
            background: rgba(13, 110, 253, .12);
            color: #0b5ed7;
        }

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
            transition: transform .35s ease;
        }

        .card-zoom:hover .thumb-16x9>img {
            transform: scale(1.06);
        }
    </style>

    <section class="container py-5">
        {{-- Header + search --}}
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
            <div>
                <h2 class="section-title mb-1">Berita SD Negeri Borokulon</h2>
                <div class="text-muted small">
                    Menampilkan {{ $posts->count() }} berita
                </div>
            </div>

            <form class="d-flex" role="search" action="{{ route('berita.index') }}" method="get">
                <input class="form-control me-2" type="search" name="q" placeholder="Cari berita..."
                    value="{{ $q }}">
                @if ($cat)
                    <input type="hidden" name="category" value="{{ $cat }}">
                @endif
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>

        {{-- Chip filter aktif --}}
        @if ($q || $cat)
            <div class="mt-3 d-flex flex-wrap align-items-center gap-2">
                <span class="text-muted small">Filter:</span>
                @if ($q)
                    <a href="{{ route('berita.index', array_filter(['category' => $cat])) }}"
                        class="btn btn-sm btn-outline-secondary rounded-pill">
                        <i class="bi bi-x-circle me-1"></i> Kata kunci: “{{ $q }}”
                    </a>
                @endif
                @if ($cat !== '')
                    <a href="{{ route('berita.index', array_filter(['q' => $q])) }}"
                        class="btn btn-sm btn-outline-secondary rounded-pill">
                        <i class="bi bi-x-circle me-1"></i> Kategori: {{ $cat }}
                    </a>
                @endif
                <a href="{{ route('berita.index') }}" class="btn btn-sm btn-link text-decoration-none">
                    Reset semua
                </a>
            </div>
        @endif

        {{-- Filter kategori --}}
        <div class="mt-3 d-flex flex-wrap gap-2">
            <a href="{{ route('berita.index', array_filter(['q' => $q])) }}"
                class="btn btn-sm {{ $cat === '' ? 'btn-primary' : 'btn-outline-primary' }}">
                Semua
            </a>
            @foreach ($categories as $c)
                <a href="{{ route('berita.index', array_filter(['q' => $q, 'category' => $c])) }}"
                    class="btn btn-sm {{ $cat === $c ? 'btn-primary' : 'btn-outline-primary' }}">
                    {{ $c }}
                </a>
            @endforeach
        </div>

        {{-- Grid berita (SEMUA ditampilkan) --}}
        <div class="row g-4 mt-2 justify-content-center">
            @forelse($posts as $p)
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="card h-100 shadow-sm border-0 card-zoom">
                        <div class="thumb-16x9">
                            @if ($p->cover)
                                <img src="{{ asset('storage/' . $p->cover) }}" alt="{{ $p->title }}" loading="lazy">
                            @else
                                {{-- sediakan file ini sebagai fallback, atau ganti ke placeholder lain --}}
                                <img src="{{ asset('assets/images/placeholder-16x9.jpg') }}" alt="No cover" loading="lazy">
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column">
                            @if ($p->category)
                                <a href="{{ route('berita.index', array_filter(['q' => $q, 'category' => $p->category])) }}"
                                    class="badge badge-soft text-decoration-none mb-2">
                                    {{ $p->category }}
                                </a>
                            @endif

                            <h5 class="card-title truncate-2 mb-1">
                                <a href="{{ route('berita.show', $p->slug) }}"
                                    class="stretched-link text-decoration-none text-dark">
                                    {{ $p->title }}
                                </a>
                            </h5>

                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-calendar3 me-1"></i>{{ optional($p->published_at)->format('d M Y') }}
                                @if ($p->author)
                                    &middot; <i class="bi bi-person me-1"></i>{{ $p->author }}
                                @endif
                            </small>

                            <p class="card-text text-muted truncate-3 mb-3">
                                {{ $p->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($p->content), 140) }}
                            </p>

                            <div class="mt-auto pt-2">
                                <a href="{{ route('berita.show', $p->slug) }}" class="btn btn-outline-primary">
                                    Baca selengkapnya
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center gap-3">
                            <i class="bi bi-info-circle text-primary fs-4"></i>
                            <div>
                                <div class="fw-semibold">Belum ada berita yang cocok.</div>
                                <div class="text-muted small">Coba ubah kata kunci atau reset filter.</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
