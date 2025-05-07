<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LevelUp\Experience\Models\Level;

class LevelSeeder extends Seeder
{
    public function run()
    {
        Level::create(['level' => 1, 'next_level_experience' => null]);  // Primer nivel sin experiencia
        Level::create(['level' => 2, 'next_level_experience' => 100]);   // Segundo nivel con 100 XP
        Level::create(['level' => 3, 'next_level_experience' => 250]);   // Tercer nivel con 250 XP
        // Agrega más niveles según tu necesidad
    }
}
