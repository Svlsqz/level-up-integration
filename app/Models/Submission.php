<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{

    protected $fillable = [
        'challenge_team_id',
        'challenge_id',
        'file_path',
        'status',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
    public function challengeTeam()
    {
        return $this->belongsTo(ChallengeTeam::class);
    }


}
