{{-- GANTI seluruh isi resources/views/work.blade.php dengan ini --}}
@extends('layouts.app')
@section('title', $project['title'] . ' | ' . config('portfolio.name'))

@section('content')
@php
    // Hanya media yang filenya ada (atau youtube yang punya id)
    $media = collect($project['media'] ?? [])->filter(function ($m) {
        return ($m['type'] ?? '') === 'youtube'
            ? !empty($m['id'])
            : (!empty($m['src']) && is_file(public_path($m['src'])));
    });
@endphp
<article class="work" style="--c: {{ $project['color'] }}">
    <h1 class="work-title" data-split>{{ $project['title'] }}</h1>
    <p class="work-meta">{{ $project['type'] }}, {{ $project['year'] }}</p>
    @if (!empty($project['role']))<p class="work-meta">Peran: {{ $project['role'] }}</p>@endif

    <p class="work-desc">{{ $project['desc'] }}</p>

    @if (!empty($project['tags']))
        <ul class="tags">@foreach ($project['tags'] as $t)<li>{{ $t }}</li>@endforeach</ul>
    @endif

    @if (!empty($project['url']))
        <div class="work-actions">
            <a href="{{ $project['url'] }}" class="btn" target="_blank" rel="noopener" data-cursor>Buka proyek &rarr;</a>
        </div>
    @endif

    @forelse ($media as $m)
        @if (($m['type'] ?? 'image') === 'video')
            <video class="work-media" src="{{ asset($m['src']) }}" playsinline preload="metadata"
                @if (!empty($m['loop'])) autoplay loop muted @else controls @endif></video>
        @elseif ($m['type'] === 'youtube')
            <div class="work-media embed">
                <iframe src="https://www.youtube-nocookie.com/embed/{{ $m['id'] }}" title="{{ $project['title'] }}" loading="lazy" allowfullscreen></iframe>
            </div>
        @else
            <img class="work-media" src="{{ asset($m['src']) }}" alt="{{ $m['alt'] ?? $project['title'] }}" loading="lazy">
        @endif
        @if (!empty($m['caption']))<p class="work-caption">{{ $m['caption'] }}</p>@endif
    @empty
        <div class="work-block"></div>
    @endforelse

    <a href="{{ route('work', $next['slug']) }}" class="work-next" style="--n: {{ $next['color'] }}" data-cursor="Lanjut">
        <span>Berikutnya</span>
        <strong>{{ $next['title'] }}</strong>
    </a>
</article>
@endsection