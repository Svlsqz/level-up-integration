<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengeTeam extends Model
{
    protected $fillable = ['name', 'challenge_id', 'created_by'];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'challenge_team_user')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
