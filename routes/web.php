<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\TeamController;
use App\Http\Controllers\Student\ChallengeController;
use App\Http\Controllers\Student\SubmissionController;
use App\Http\Controllers\Student\ChallengeTeamController;
use App\Http\Controllers\Student\StudentProfileController;

// Página de inicio
Route::get('/', function () {
    return view('home');
});


// Leaderboard general
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

// Dashboard (post-login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para gestión de equipos globales (si aún los usas)
//Route::prefix('student/teams')->name('student.teams.')->group(function () {
//    Route::get('/', [TeamController::class, 'index'])->name('index');
//    Route::get('/create', [TeamController::class, 'create'])->name('create');
//    Route::get('/{team}', [TeamController::class, 'show'])->name('show');
//    Route::post('/', [TeamController::class, 'store'])->name('store');
//    Route::put('/{team}', [TeamController::class, 'update'])->name('update');
//    Route::delete('/{team}', [TeamController::class, 'destroy'])->name('destroy');
//});


Route::middleware('auth')->prefix('student')->name('student.')->group(function () {
    Route::get('/teams', [ChallengeTeamController::class, 'index'])->name('challenge-teams.index');
});


Route::prefix('student/challenge-teams')->name('student.challenge-teams.')->middleware('auth')->group(function () {
    Route::get('/', [ChallengeTeamController::class, 'index'])->name('index');
});


// Rutas para flujo gamificado de estudiantes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    // Ver retos
    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('/challenges/{challenge}', [ChallengeController::class, 'show'])->name('challenges.show');

    // Subir propuesta
    Route::get('/challenges/{challenge}/submit', [SubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/challenges/{challenge}/submit', [SubmissionController::class, 'store'])->name('submissions.store');

    // Crear equipo para un reto
    Route::get('/challenges/{challenge}/teams/create', [ChallengeTeamController::class, 'create'])->name('challenge-teams.create');
    Route::post('/challenges/{challenge}/teams', [ChallengeTeamController::class, 'store'])->name('challenge-teams.store');
});

Route::get('/student/profile', [StudentProfileController::class, 'show'])
    ->middleware('auth')
    ->name('student.profile');


// Rutas de autenticación de Breeze (login, register, forgot password, etc.)
require __DIR__.'/auth.php';
