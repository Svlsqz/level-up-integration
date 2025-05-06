<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;
use App\Models\Submission;
use App\Models\ChallengeTeam;

class SubmissionController extends Controller
{
    public function create(Challenge $challenge)
    {
        $user = Auth::user();

        // Encuentra el equipo del usuario para ese challenge
        $team = $user->challengeTeams()
            ->where('challenge_id', $challenge->id)
            ->first();

        // Si no tiene equipo, redirige con error
        if (!$team) {
            return redirect()->route('student.challenges.show', $challenge)
                ->with('error', 'You must be in a team to submit.');
        }

        // Verifica si ya envió algo
        $existing = $team->submissions()
            ->where('challenge_id', $challenge->id)
            ->first();

        return view('student.submissions.create', compact('challenge', 'team', 'existing'));
    }

    public function store(Request $request, Challenge $challenge)
    {

//        dd('Store method reached');

        $request->validate([
            'file' => 'required|file|mimes:pdf,zip|max:5120', // máx. 5MB
        ]);

        $team = Auth::user()->challengeTeams()
            ->where('challenge_id', $challenge->id)
            ->first();


        if (!$team) {
            return back()->withErrors(['file' => 'You must be in a team to submit.']);
        }

        // Guardar archivo
        $path = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'challenge_team_id' => $team->id,
            'challenge_id' => $challenge->id,
            'file_path' => $path,
            'status' => 'submitted',
        ]);

        return redirect()
            ->route('student.challenges.show', $challenge)
            ->with('success', 'Your submission has been uploaded successfully!');
    }
}
