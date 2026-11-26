<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        Skill::truncate();

        $names = ['Motion graphics', 'GFX', 'Video Editing', 'IoT', '3D Modeling'];

        foreach ($names as $i => $name) {
            Skill::create([
                'name'       => $name,
                'category'   => 'Keahlian',
                'sort_order' => $i + 1,
            ]);
        }
    }
}
