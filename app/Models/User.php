<?php

namespace App\Models;

use App\Traits\HasXPLogging;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LevelUp\Experience\Concerns\GiveExperience;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use HasXPLogging, GiveExperience {
        GiveExperience::addPoints as addPointsBase;
        GiveExperience::deductPoints as deductPointsBase;
        HasXPLogging::addPoints insteadof GiveExperience;
        HasXPLogging::deductPoints insteadof GiveExperience;
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'entity_id',
        'is_visible',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_visible' => 'boolean',
        ];
    }

    public function challengeTeams()
    {
        return $this->belongsToMany(ChallengeTeam::class, 'challenge_team_user')
            ->withPivot('role')
            ->withTimestamps();
    }


    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function xpLogs()
    {
        return $this->hasMany(XPLog::class);
    }

    public function totalXPLogged(): int
    {
        return $this->xpLogs()->sum('points');
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class)->withTimestamps();
    }

    public function giveReward(Reward $reward): void
    {
        $this->rewards()->syncWithoutDetaching($reward->id);
    }

    public function level(): int
    {
        return (int) floor($this->totalXPLogged() / 100);
    }

    public function xpToNextLevel(): int
    {
        return $this->xpForNextLevel() - $this->totalXPLogged();
    }

    public function xpForCurrentLevel(): int
    {
        return $this->level() * 100;
    }

    public function xpForNextLevel(): int
    {
        return ($this->level() + 1) * 100;
    }

    public function completedActivitiesCount(): int
    {
        // Puedes personalizar esto más adelante
        return $this->xpLogs()->count();
    }
}
