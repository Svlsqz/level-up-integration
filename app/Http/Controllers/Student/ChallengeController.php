<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use App\Models\ChallengeTeam;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::latest()->get();
        return view('student.challenges.index', compact('challenges'));
    }

    public function show(Challenge $challenge)
    {
        $user = Auth::user();

        $team = $user->challengeTeams()
            ->where('challenge_id', $challenge->id)
            ->first();

        $submission = null;

        if ($team) {
            $submission = $team->submissions()->first();
        }

        return view('student.challenges.show', compact('challenge', 'team', 'submission'));
    }

}
