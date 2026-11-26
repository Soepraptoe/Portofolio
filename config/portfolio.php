<?php
// File: config/portfolio.php
// Semua isi portofolio ada di sini. Ganti teks placeholder dengan datamu.
return [
    'name'  => 'Teddy Dimas Suprapto',
    'role'  => 'Motion Graphic Designer',
    'city'  => 'Surabaya',
    'email' => 'teddydimassuprapto@gmail.com',
    'intro' => 'toneneng, hihu',

    'chips' => ['learner', 'jacks of all trades', 'good communicator'],

    'about' => [
        'who'      => 'Saya seorang pemula yang terus mengembangkan kemampuan di bidang teknologi, desain, pemrograman, dan multimedia. Saya memiliki ketertarikan pada bidang IoT atau Internet of Things, serta terbiasa mengeksplorasi bagaimana berbagai elemen tersebut saling terhubung untuk menciptakan solusi yang kreatif dan fungsional.',
        'approach' => 'hooh',
        'details'  => [
            'Nama'       => 'Teddy Dimas Suprapto',
            'Domisili'   => 'Surabaya, Indonesia',
            'Pendidikan' => 'Politeknik Elektronika Negeri Surabaya',
            'Email'      => 'teddydimassuprapto@gmail.com',
        ],
    ],

    'skills' => ['Motion graphics', 'GFX', 'Video Editing', 'IoT', '3D Modeling'], // dipakai marquee

    'education' => [
    ['period' => '2025 - sekarang', 'title' => 'Sarjana Terapan (D4) Teknologi Rekayasa Multimedia', 'org' => 'Politeknik Elektronika Negeri Surabaya',
     'tags' => ['Multimedia']],
    ['period' => '2021 - 2025', 'title' => 'Teknik Elektronika Daya & Komunikasi', 'org' => 'SMK Negeri 2 Surabaya',
     'tags' => []],
],

    // ---------- Pengalaman (terbaru di atas) ----------
'experience' => [
    ['period' => 'Feb 2024 - Jul 2024', 'title' => 'Technician Intern', 'org' => 'CV. Global Technology Indonesia',
     'desc' => 'Mengembangkan dan merakit sistem antrean tiket untuk lingkungan perbankan, serta mengelola jaringan access point untuk sistem tampilan jarak jauh.',
     'tags' => ['Elektronika', 'Jaringan', 'Sistem antrean']],

    ['period' => 'Okt 20?? - Feb 2024', 'title' => 'Service Technician Intern', 'org' => 'PT. Bhakti Idola Tama', // CEK: di CV tertulis "Oct 2024 - Feb 2024"
     'desc' => 'Memperbaiki peralatan elektronik rumah tangga: mendiagnosis masalah, melakukan troubleshooting, dan perbaikan di tingkat komponen.',
     'tags' => ['Troubleshooting', 'Elektronika']],

    ['period' => 'Des 2023', 'title' => 'Publikasi, Desain & Dokumentasi', 'org' => 'Instagram ELITE, Ekskul Robotik', // CEK: PDD = Publikasi, Desain, Dokumentasi?
     'desc' => 'Bertugas di divisi publikasi, desain, dan dokumentasi untuk akun Instagram ELITE.',
     'tags' => ['Publikasi', 'Desain', 'Dokumentasi']],

    ['period' => 'Jan 2023', 'title' => 'Panitia Proyek', 'org' => 'Penyambutan Kepala Sekolah Baru, SMKN 2 Surabaya',
     'desc' => 'Terlibat sebagai panitia proyek dalam acara penyambutan kepala sekolah baru.',
     'tags' => ['Kepanitiaan', 'Kerja tim']],

    ['period' => 'Apr 2022', 'title' => 'Publikasi, Desain & Dokumentasi', 'org' => 'Ramadhan ELITE, Ekskul Robotik', // CEK: PDD
     'desc' => 'Bertugas di divisi publikasi, desain, dan dokumentasi pada kegiatan Ramadhan ELITE.',
     'tags' => ['Publikasi', 'Desain', 'Dokumentasi']],

    ['period' => '2021 - 2025', 'title' => 'Electronic Innovation Center (ELITE)', 'org' => 'Ekstrakurikuler robotik, SMKN 2 Surabaya',
     'desc' => 'mengikuti banyak lomba elektronika, seperti lomba karya cipta ilmiah dan robotik dengan jenis robot transporter, line follower, soccerbot, dan kapal. di banyak universitas surabaya, paling sering di trio sukolilo yaitu ITS, PENS, PPNS', // CEK: isi perannya, atau hapus baris ini
     'tags' => ['Anggota', 'Leader', 'Coach']],
],

'achievements' => [
    ['period' => '2023', 'title' => 'Juara 3, Fire Fighting Roboboat',       'org' => 'Automation Week, PPNS'],
    ['period' => '2023', 'title' => 'Juara 3, 3D Craft',                     'org' => 'Festival Teknik, UMS'],
    ['period' => '2023', 'title' => 'Juara 3, Robot Soccer',                 'org' => 'Industrial Automation and Robotic Competition, ITS'],
    ['period' => '2022', 'title' => 'Juara 2, Industrial Design Layout Competition', 'org' => 'Festival Teknik, UMS'],
    ['period' => 'Mei 2025', 'title' => 'Sertifikasi: Competent Electronic Equipment Assembler (Inverter)', 'org' => 'Samsung & SMKN 2 Surabaya'],
],

'toolkit' => [
    ['name' => 'Motion & Video',       'desc' => 'Alat untuk animasi dan penyuntingan video.', 'items' => ['Adobe After Effects', 'CapCut']],
    ['name' => 'Desain Grafis',               'desc' => 'Dasar visual dan perencanaan karya.', 'items' => ['Adobe Illustrator', 'Figma', 'Canva', 'Pixellab', 'Photophea']],
    ['name' => 'Elektronika & IoT',    'desc' => 'Latar belakang teknis dari SMK dan magang.', 'items' => ['Arduino', 'IoT', 'WokWi', 'Fritzing', 'Proteus', 'EAGLE']],
    ['name' => '3D Design',           'desc' => 'Alat untuk modeling dan render.',      'items' => ['Blender']],
],

    'socials' => [
        'Instagram' => 'https://instagram.com/',
        'Github'   => 'https://github.com/',
        'LinkedIn' => 'https://linkedin.com/',
    ],

'projects' => [
    [
        'slug' => 'animasi-bumper', 'title' => 'Animasi Bumper', 'year' => 2026, 'type' => 'Animasi 2D', 'color' => '#FF4FA3',
        'role' => 'Storyboard dan animasi satu scene (kerja tim)',
        'desc' => 'membuat animasi untuk konten event Immersive Fiesta 2026',
        'tags' => ['motion graphics', 'After Effects'],
        'cover' => 'images/karya/animasi-bumper.png',
        'media' => [
            ['type' => 'video', 'src' => 'videos/animasi-bumper.mp4', 'loop' => true]
        ],
        'url' => null,
    ],
    [
        'slug' => 'animasi-shape', 'title' => 'Animasi Shape', 'year' => 2026, 'type' => 'Motion graphics', 'color' => '#FFE600',
        'role' => 'Animator',
        'desc' => 'Animasi shape motion graphics yang menekankan prinsip animasi untuk menciptakan gerakan yang halus dan menarik.',
        'tags' => ['After Effects', 'Prinsip animasi'],
        'cover' => 'images/karya/animasi-shape.png',
        'media' => [
            ['type' => 'video', 'src' => 'videos/animasi-shape.mp4', 'loop' => true],
        ],
        'url' => null,
    ],
    [
        'slug' => 'Desain 3D', 'title' => 'Desain 3D', 'year' => 2026, 'type' => '3D Design', 'color' => '#7DF9C2',
        'role' => 'Desainer 3D',
        'desc' => 'Eksplorasi pertama dalam modeling 3D menggunakan Blender, menciptakan objek sumur',
        'tags' => ['Blender', '3D Modeling'],
        'cover' => 'images/karya/desain-3d.png',
        'media' => [
            ['type' => 'image', 'src' => 'images/karya/desain-3d.png'],
        ],
        'url' => null,
    ],
    [
        'slug' => 'e-saving', 'title' => 'E-Saving', 'year' => 2022, 'type' => 'IoT', 'color' => '#FF7A2F',
        'role' => 'Pembuat sistem',
        'desc' => 'Sistem monitoring energi rumah tangga berbasis IoT. Sensor dan Arduino dipakai untuk mengambil dan memantau data kelistrikan secara real-time.',
        'tags' => ['Arduino', 'IoT', 'Sensor'],
        'cover' => 'images/karya/e-saving.jpg',
        'media' => [
            ['type' => 'image', 'src' => 'images/karya/e-saving.jpg'],
        ],
        'url' => 'https://youtu.be/zBlOCLLhVo4?si=eybeFWrkuCCm1dO5&t=128',
    ],
    [
        'slug' => 'rain-detector', 'title' => 'Rain Detector', 'year' => 2023, 'type' => 'IoT', 'color' => '#FF4FA3', // CEK: kalimat desc di bawah
        'role' => 'Pembuat sistem',
        'desc' => 'Sistem deteksi lingkungan berbasis sensor IoT dengan Arduino, dipakai untuk pemantauan dan respons real-time.',
        'tags' => ['Arduino', 'IoT', 'Sensor'],
        'cover' => 'images/karya/rain-detector.png',
        'media' => [
            ['type' => 'image', 'src' => 'images/karya/rain-detector.png'],
        ],
        'url' => 'https://www.instagram.com/reel/CnE9M_ZBWn4/?dmpr=MWptcjVhcng2b291cg==',
    ],
],
];
