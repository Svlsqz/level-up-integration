<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;
use App\Models\ChallengeTeam;
use Illuminate\Support\Facades\Auth;

class ChallengeTeamController extends Controller
{

    public function index()
    {
        $challengeTeams = Auth::user()
            ->challengeTeams()
            ->with(['challenge']) // opcional: si tienes esas relaciones
            ->get();

        return view('student.challenge_teams.index', compact('challengeTeams'));
    }


    public function create(Challenge $challenge)
    {
        return view('student.challenge_teams.create', compact('challenge'));
    }

    public function store(Request $request, Challenge $challenge)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team = ChallengeTeam::create([
            'name' => $request->name,
            'challenge_id' => $challenge->id,
            'created_by' => auth()->id(),
        ]);

        // Asegura que se haya creado
        if ($team) {
            $team->users()->attach(auth()->id(), ['role' => 'leader']);
        }

        return redirect()->route('student.challenges.show', $challenge)
            ->with('success', 'Team created successfully!');
    }

}
