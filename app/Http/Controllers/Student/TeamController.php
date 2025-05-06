<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <<---- AGREGA ESTO
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teams = $user->teams; // relación belongsToMany
        return view('student.teams.index', compact('teams'));
    }

    public function create()
    {
        $entities = Entity::all();
        return view('student.teams.create', compact('entities'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'entity_id' => 'required|exists:entities,id', // asegúrate de tener la tabla `entities`
        ]);

        $team = Team::create([
            'name' => $request->name,
            'entity_id' => $request->entity_id,
        ]);

        $team->students()->attach(Auth::id(), [
            'role' => 'leader',
            'total_xp' => 0,
        ]);

        return redirect()->route('student.teams.index')->with('success', 'Team created successfully!');
    }

}


