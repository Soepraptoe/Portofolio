<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        Experience::truncate();

        $rows = [
            ['period' => 'Feb 2024 - Jul 2024', 'title' => 'Technician Intern', 'org' => 'CV. Global Technology Indonesia',
             'description' => 'Mengembangkan dan merakit sistem antrean tiket untuk lingkungan perbankan, serta mengelola jaringan access point untuk sistem tampilan jarak jauh.',
             'tags' => ['Elektronika', 'Jaringan', 'Sistem antrean']],

            ['period' => 'Okt 2024 - Feb 2024', 'title' => 'Service Technician Intern', 'org' => 'PT. Bhakti Idola Tama',
             'description' => 'Memperbaiki peralatan elektronik rumah tangga: mendiagnosis masalah, melakukan troubleshooting, dan perbaikan di tingkat komponen.',
             'tags' => ['Troubleshooting', 'Elektronika']],

            ['period' => 'Des 2023', 'title' => 'Publikasi, Desain & Dokumentasi', 'org' => 'Instagram ELITE, Ekskul Robotik',
             'description' => 'Bertugas di divisi publikasi, desain, dan dokumentasi untuk akun Instagram ELITE.',
             'tags' => ['Publikasi', 'Desain', 'Dokumentasi']],

            ['period' => 'Jan 2023', 'title' => 'Panitia Proyek', 'org' => 'Penyambutan Kepala Sekolah Baru, SMKN 2 Surabaya',
             'description' => 'Terlibat sebagai panitia proyek dalam acara penyambutan kepala sekolah baru.',
             'tags' => ['Kepanitiaan', 'Kerja tim']],

            ['period' => 'Apr 2022', 'title' => 'Publikasi, Desain & Dokumentasi', 'org' => 'Ramadhan ELITE, Ekskul Robotik',
             'description' => 'Bertugas di divisi publikasi, desain, dan dokumentasi pada kegiatan Ramadhan ELITE.',
             'tags' => ['Publikasi', 'Desain', 'Dokumentasi']],

            ['period' => '2021 - 2025', 'title' => 'Electronic Innovation Center (ELITE)', 'org' => 'Ekstrakurikuler robotik, SMKN 2 Surabaya',
             'description' => 'mengikuti banyak lomba elektronika, seperti lomba karya cipta ilmiah dan robotik dengan jenis robot transporter, line follower, soccerbot, dan kapal. di banyak universitas surabaya, paling sering di trio sukolilo yaitu ITS, PENS, PPNS',
             'tags' => ['Anggota', 'Leader', 'Coach']],
        ];

        foreach ($rows as $i => $row) {
            Experience::create($row + ['sort_order' => $i + 1]);
        }
    }
}
