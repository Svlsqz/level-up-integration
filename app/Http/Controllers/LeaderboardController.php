<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;
use LevelUp\Experience\Facades\Leaderboard;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $entityId = $request->query('entity_id');

        // Obtener top 10 usuarios con filtro por role y opcionalmente universidad
        $topUsers = Leaderboard::generate()
            ->filter(function ($user) use ($entityId) {
                return $user->role === 'student' &&
                    (!$entityId || $user->entity_id == $entityId);
            })
            ->take(10);

        // Obtener solo entidades tipo universidad
        $universities = Entity::where('type', 'university')->get();

        return view('leaderboard', compact('topUsers', 'universities'));
    }
}
