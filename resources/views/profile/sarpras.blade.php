@extends('layouts.app')

@section('content')
    <style>
        .thumb-4x3 {
            position: relative;
            width: 100%;
            padding-top: 75%;
            overflow: hidden;
            background: #f2f5f9;
        }

        .thumb-4x3>img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .card-zoom:hover .thumb-4x3>img {
            transform: scale(1.06);
        }

        .badge-soft {
            background: rgba(13, 110, 253, .12);
            color: #0b5ed7;
        }

        .truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            /* diperpanjang dari 2 ke 3 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
            <h2 class="section-title mb-0">Sarana &amp; Prasarana</h2>

            {{-- Optional: total item --}}
            @isset($items)
                <span class="text-muted small">{{ method_exists($items, 'total') ? $items->total() : $items->count() }}
                    item</span>
            @endisset
        </div>

        @if ($items->isEmpty())
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="bi bi-info-circle text-primary fs-4"></i>
                    <div>
                        <div class="fw-semibold">Belum ada data sarana/prasarana.</div>
                        <div class="text-muted small">Tambah data dari menu Admin &raquo; Sarpras.</div>
                    </div>
                </div>
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3 justify-content-center">
                @foreach ($items as $s)
                    @php
                        // Fallback gambar jika kosong
                        $img =
                            $s->image_url ??
                            (isset($s->image_path)
                                ? asset('storage/' . $s->image_path)
                                : asset('assets/images/placeholder-sarpras.jpg'));
                    @endphp

                    <div class="col">
                        <a href="{{ route('profile.sarpras.show', $s->slug) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 card-zoom">
                                <div class="thumb-4x3">
                                    <img src="{{ $img }}" alt="{{ $s->title }}" loading="lazy">
                                </div>

                                <div class="card-body">
                                    {{-- Judul + ikon --}}
                                    <h6 class="fw-bold mb-1 text-dark">
                                        @if (!empty($s->icon))
                                            <i class="bi {{ $s->icon }} text-primary me-1"></i>
                                        @endif
                                        {{ $s->title }}
                                    </h6>

                                    {{-- Badge kategori / kondisi / jumlah (opsional, tampil kalau ada) --}}
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        @if (!empty($s->category))
                                            <span class="badge badge-soft rounded-pill">
                                                <i class="bi bi-grid me-1"></i>{{ $s->category }}
                                            </span>
                                        @endif
                                        @if (!empty($s->condition))
                                            <span class="badge bg-success-subtle text-success rounded-pill">
                                                <i class="bi bi-activity me-1"></i>{{ $s->condition }}
                                            </span>
                                        @endif
                                        @if (!empty($s->quantity))
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill">
                                                <i class="bi bi-123 me-1"></i>{{ $s->quantity }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Deskripsi singkat --}}
                                    @if (!empty($s->description))
                                        <p class="text-muted mb-0 truncate-2">{{ $s->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination (kalau koleksi paginator) --}}
            @if (method_exists($items, 'links'))
                <div class="mt-4">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </section>
@endsection
