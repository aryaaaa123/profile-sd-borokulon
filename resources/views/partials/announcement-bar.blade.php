@if(($items ?? collect())->count())
<section class="announce" aria-label="Pengumuman">
  <div class="container d-flex align-items-center gap-3">
    <i class="bi bi-megaphone-fill fs-5 text-white-75"></i>

    <div class="announce-scroll" role="region" aria-live="polite">
      {{-- gandakan supaya loop mulus --}}
      <div class="announce-track">
        @foreach($items as $a)
          <span class="announce-item">🔔 {{ $a->text }}</span>
          <span class="announce-sep">•</span>
        @endforeach
        @foreach($items as $a)
          <span class="announce-item">🔔 {{ $a->text }}</span>
          <span class="announce-sep">•</span>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif
<script>
  (function(){
    const nav = document.querySelector('.navbar.sticky-top');
    const bar = document.querySelector('.announce');
    if(!nav || !bar) return;
    const setTop = () => { bar.style.position='sticky'; bar.style.top = nav.offsetHeight + 'px'; };
    setTop(); window.addEventListener('resize', setTop);
  })();
</script>

<style>
  /* Bar gaya modern */
  .announce{
    --bg1:#0d6efd; --bg2:#0b5ed7; --speed:26s; --fade:40px;
    background: linear-gradient(90deg,var(--bg1),var(--bg2));
    color:#fff; padding:.45rem 0; position:relative; z-index:1030;
    box-shadow: inset 0 -1px 0 rgba(255,255,255,.08);
  }
  .text-white-75{ color:rgba(255,255,255,.85); }

  /* area scroll + fade kiri/kanan (mask) */
  .announce-scroll{
    flex:1 1 auto; overflow:hidden; line-height:1.5;
    font-weight:600; letter-spacing:.1px;
    -webkit-mask-image: linear-gradient(to right, transparent, #000 var(--fade),
                                        #000 calc(100% - var(--fade)), transparent);
            mask-image: linear-gradient(to right, transparent, #000 var(--fade),
                                        #000 calc(100% - var(--fade)), transparent);
  }

  .announce-track{
    display:inline-flex; gap:.9rem; white-space:nowrap;
    animation:announceMove var(--speed) linear infinite;
    will-change:transform;
  }
  .announce-scroll:hover .announce-track{ animation-play-state: paused; }

  .announce-item{ opacity:.98; }
  .announce-sep{ opacity:.55; }

  @keyframes announceMove{
    from{ transform:translateX(0); }
    to  { transform:translateX(-50%); } /* track digandakan */
  }

  /* Responsif kecil: lebih lambat dan fade lebih kecil */
  @media (max-width: 576px){
    .announce{ --speed: 34s; --fade:22px; }
  }
</style>
