
@extends('layouts.app')

@section('content')
<div class="preloader" aria-hidden="true">
    <img class="preloader-icon" src="{{ asset('images/taggg.png') }}" alt="">
    <div class="bar"><span class="bar-fill"></span></div>
</div>

{{-- HERO --}}
<section class="hero" id="top">
    <h1 class="hero-title" data-split>{{ config('portfolio.name') }}</h1>

    <div class="hero-bottom">
        <p class="hero-bio">{{ config('portfolio.intro') }}</p>
        <div>
            <ul class="chips">
                @foreach (config('portfolio.chips') as $chip)<li>{{ $chip }}</li>@endforeach
            </ul>
        </div>
    </div>

    <div class="sticker s1" style="--c:#FF4FA3">After Effects</div>
    <div class="sticker s2" style="--c:#FFE600">Adobe Illustrator</div>
    <div class="sticker s3" style="--c:#7DF9C2">Graphic Design</div>
    <div class="sticker s4" style="--c:#FF7A2F">Blender</div>
</section>

<div class="marquee" aria-hidden="true">
    <div class="marquee-track">
        @for ($i = 0; $i < 2; $i++)
            @foreach ($skills as $skill)<span>{{ $skill->name }}</span><i></i>@endforeach
        @endfor
    </div>
</div>

{{-- TENTANG --}}
<section class="sec dark" id="about">
    <div class="sec-head"><h2>Tentang aku</h2></div>
    <div class="about-grid">
        @php $photo = config('portfolio.photo', 'images/foto.jpg'); @endphp
        <figure class="photo">
            <div class="photo-frame">
                @if (file_exists(public_path($photo)))
                    <img src="{{ asset($photo) }}" alt="Foto {{ config('portfolio.name') }}">
                @else
                    <p class="photo-empty">Taruh fotomu di<br>public/{{ $photo }}</p>
                @endif
            </div>
        </figure>
        <div>
            <div class="about-block"><h3>Siapa aku</h3><p>{{ config('portfolio.about.who') }}</p></div>
            <dl class="details">
                @foreach (config('portfolio.about.details') as $label => $value)
                    <div><dt>{{ $label }}</dt><dd>{{ $value }}</dd></div>
                @endforeach
            </dl>
            <a href="{{ config('portfolio.cv') }}" class="btn solid about-cv" download data-cursor>Unduh CV</a>
        </div>
    </div>
</section>

{{-- PENGALAMAN, PENDIDIKAN, PRESTASI: masing-masing section sendiri --}}
@php
    $journey = [
        ['education',    'Pendidikan',               'sun'],
        ['experience',   'Pengalaman',               'light'],
        ['achievements', 'Prestasi dan sertifikasi', 'ember'],
    ];
@endphp
@foreach ($journey as [$key, $label, $tone])
    @php
        // Pengalaman diambil dari database, sisanya masih dari config/portfolio.php
        $items = $key === 'experience'
            ? $experiences->map(fn ($e) => [
                'period' => $e->period,
                'title'  => $e->title,
                'org'    => $e->org,
                'desc'   => $e->description,
                'tags'   => $e->tags ?? [],
            ])->all()
            : config('portfolio.' . $key, []);
    @endphp
    @if (count($items))
        <section class="sec tight {{ $tone }}" id="{{ $key }}">
            <div class="split">
                <header class="split-head">
                    <h2>{{ $label }}</h2>
                </header>
                <div class="split-list">
                    @foreach ($items as $item)
                        <article class="job">
                            <span class="job-period">{{ $item['period'] }}</span>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p class="job-org">{{ $item['org'] }}</p>
                            </div>
                            <div>
                                <p>{{ $item['desc'] ?? '' }}</p>
                                <ul class="tags">@foreach ($item['tags'] ?? [] as $t)<li>{{ $t }}</li>@endforeach</ul>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endforeach

{{-- ALAT --}}
<section class="sec blue" id="skills">
    <div class="sec-head"><h2>Alat yang kupakai</h2></div>
    <div class="toolkit">
        @foreach (config('portfolio.toolkit') as $group)
            <div class="tool-group">
                <h3>{{ $group['name'] }}</h3>
                <p>{{ $group['desc'] }}</p>
                <ul class="chips">@foreach ($group['items'] as $item)<li>{{ $item }}</li>@endforeach</ul>
            </div>
        @endforeach
    </div>
</section>

{{-- KARYA (scroll horizontal) --}}
<section class="works" id="works">
    <div class="works-track">
        <div class="works-intro"><h2>Karya pilihan</h2></div>
        @foreach (config('portfolio.projects') as $p)
            <a href="{{ route('work', $p['slug']) }}" class="card" style="--c: {{ $p['color'] }}" data-cursor="Buka">
                <div class="card-media">
                    @if (!empty($p['cover']) && is_file(public_path($p['cover'])))
                        <img src="{{ asset($p['cover']) }}" alt="{{ $p['title'] }}" loading="lazy">
                    @endif
                    <span class="card-num">{{ sprintf('%02d', $loop->iteration) }}</span>
                </div>
                <div class="card-info">
                    <h3>{{ $p['title'] }}</h3>
                    <span>{{ $p['type'] }}, {{ $p['year'] }}</span>
                </div>
                <ul class="tags">@foreach ($p['tags'] ?? [] as $t)<li>{{ $t }}</li>@endforeach</ul>
                <p class="card-desc">{{ $p['desc'] }}</p>
            </a>
        @endforeach
    </div>
</section>

{{-- KONTAK --}}
<section class="touch" id="contact">
    <div class="touch-center">
        <h2>Contact me</h2>

        <form class="mail-card" method="POST" action="{{ route('contact.send') }}">
            @csrf
            @if (session('sent'))<p class="mail-ok" role="status">Pesan terkirim. Aku balas secepatnya.</p>@endif
            @if (session('failed'))<p class="mail-err" role="alert">Pesan belum terkirim. Coba lagi sebentar lagi.</p>@endif

            {{-- jebakan untuk bot: jangan diisi --}}
            <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">

            <label>Nama
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" maxlength="100" autocomplete="name" required>
            </label>
            @error('name')<p class="mail-err">{{ $message }}</p>@enderror

            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" placeholder="kamu@contoh.com" maxlength="150" autocomplete="email" required>
            </label>
            @error('email')<p class="mail-err">{{ $message }}</p>@enderror

            <label>Pesan
                <textarea name="message" rows="6" placeholder="Tulis pesanmu di sini" maxlength="3000" required>{{ old('message') }}</textarea>
            </label>
            @error('message')<p class="mail-err">{{ $message }}</p>@enderror

            <button type="submit">Kirim pesan</button>
        </form>

        <ul class="touch-links">
            @foreach (config('portfolio.socials') as $name => $url)
                <li><a href="{{ $url }}" target="_blank" rel="noopener" data-cursor>{{ $name }}</a></li>
            @endforeach
        </ul>
    </div>

    <p class="foot">© {{ date('Y') }} {{ config('portfolio.name') }}. Dibuat dengan Laravel dan GSAP.</p>
</section>
