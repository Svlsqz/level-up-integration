<?php

namespace App\Http\Controllers;

use LevelUp\Experience\Facades\Leaderboard;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Obtener top 10 usuarios por experiencia
        $topUsers = Leaderboard::generate()
            ->filter(fn($user) => $user->role === 'student')
            ->take(10);


        return view('leaderboard', compact('topUsers'));
    }
}
