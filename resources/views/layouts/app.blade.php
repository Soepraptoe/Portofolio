
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('portfolio.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,800&family=Instrument+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script>if (sessionStorage.getItem('nav')) document.documentElement.classList.add('arriving')</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="curtain" aria-hidden="true"></div>
    <div class="cursor" aria-hidden="true"><span></span></div>

    <header class="nav">
        <a href="{{ route('home') }}#top" class="nav-logo" data-cursor>{{ config('portfolio.name') }}</a>
        <nav aria-label="Menu utama">
            <a href="{{ route('home') }}#top" data-cursor>Home</a>
            <a href="{{ route('home') }}#about" data-cursor>Tentang</a>
            <a href="{{ route('home') }}#education" data-cursor>Pendidikan</a>
            <a href="{{ route('home') }}#experience" data-cursor>Pengalaman</a>
            <a href="{{ route('home') }}#achievements" data-cursor>Prestasi</a>
            <a href="{{ route('home') }}#works" data-cursor>Karya</a>
            <a href="{{ route('home') }}#contact" data-cursor>Kontak</a>
        </nav>
    </header>

    <main>@yield('content')</main>
</body>
</html>