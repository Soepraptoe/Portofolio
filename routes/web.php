<?php
// File: routes/web.php
use App\Http\Controllers\PortfolioController;
use App\Models\PesanKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', [PortfolioController::class, 'index'])->name('home');

Route::get('/work/{slug}', function (string $slug) {
    $projects = collect(config('portfolio.projects'))->values();
    $project  = $projects->firstWhere('slug', $slug);
    abort_unless($project, 404);

    $i    = $projects->search($project);
    $next = $projects[($i + 1) % $projects->count()];

    return view('work', compact('project', 'next'));
})->name('work');

Route::get('/perjalanan/{page}', function (string $page) {
    $pages = [
        'pengalaman' => ['title' => 'Pengalaman',              'key' => 'experience',   'color' => '#FFE600'],
        'pendidikan' => ['title' => 'Pendidikan',              'key' => 'education',    'color' => '#7DF9C2'],
        'prestasi'   => ['title' => 'Prestasi dan sertifikasi', 'key' => 'achievements', 'color' => '#FF7A2F'],
    ];

    // Hanya halaman yang datanya terisi yang tersedia
    $available = collect($pages)->filter(fn ($p) => count(config('portfolio.' . $p['key'], [])) > 0);
    abort_unless($available->has($page), 404);

    $slugs   = $available->keys()->values();
    $nextKey = $slugs[($slugs->search($page) + 1) % $slugs->count()];

    return view('journey', [
        'current' => $available[$page],
        'items'   => config('portfolio.' . $available[$page]['key']),
        'next'    => $available[$nextKey] + ['slug' => $nextKey],
    ]);
})->name('journey');

// Form "Kirim email langsung"
Route::post('/contact', function (Request $request) {
    $back = fn () => redirect(route('home') . '#contact');

    // Jebakan bot: kolom "website" tersembunyi, manusia tidak mengisinya.
    if ($request->filled('website')) {
        return $back()->with('sent', true);
    }

    $v = Validator::make($request->all(), [
        'name'    => ['required', 'string', 'max:100'],
        'email'   => ['required', 'email', 'max:150'],
        'message' => ['required', 'string', 'max:3000'],
    ], [
        'required' => 'Kolom ini wajib diisi.',
        'email'    => 'Format email belum benar.',
        'max'      => 'Terlalu panjang.',
    ]);

    if ($v->fails()) {
        return $back()->withErrors($v)->withInput();
    }

    $data = $v->validated();

    // Simpan dulu ke database, supaya pesan tidak hilang walaupun email gagal terkirim
    PesanKontak::create([
        'nama'  => $data['name'],
        'email' => $data['email'],
        'pesan' => $data['message'],
    ]);

    try {
        Mail::raw("Dari: {$data['name']} <{$data['email']}>\n\n{$data['message']}", function ($m) use ($data) {
            $m->to(config('portfolio.email'))
              ->replyTo($data['email'], $data['name'])
              ->subject('Pesan baru dari portofolio: ' . $data['name']);
        });
    } catch (\Throwable $e) {
        report($e); // email gagal, tapi pesan sudah aman di database
    }

    return $back()->with('sent', true);
})->middleware('throttle:5,1')->name('contact.send');
