<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Entity;
use App\Models\User;
use LevelUp\Experience\Facades\Leaderboard;

class LeaderboardPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Leaderboard';
    protected static string $view = 'filament.pages.leaderboard-page';

    public string $tab = 'universities';

    public function getUniversitiesProperty()
    {
        return Entity::where('type', 'university')
            ->with(['users' => fn ($q) => $q->where('role', 'student')])
            ->get()
            ->map(function ($entity) {
                return (object) [
                    'name' => $entity->name,
                    'total_xp' => $entity->users->sum(fn ($user) => $user->getPoints()),
                    'students_count' => $entity->users->count(),
                ];
            })
            ->sortByDesc('total_xp')
            ->values();
    }

    public function getStudentsProperty()
    {
        return Leaderboard::generate()
            ->filter(fn ($user) => $user->role === 'student')
            ->take(10);
    }
}
