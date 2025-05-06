@extends('layouts.student')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4">

        <h1 class="text-3xl font-bold mb-8">My Challenge Teams</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($challengeTeams->isEmpty())
            <div class="bg-white shadow p-6 rounded-lg text-center">
                <p class="text-gray-600 text-lg">You are not part of any team for any challenge yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($challengeTeams as $team)
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-xl font-semibold mb-2">{{ $team->name }}</h2>
                        <p class="text-sm text-gray-600 mb-2">For Challenge: <strong>{{ $team->challenge->title }}</strong></p>
                        <p class="text-sm text-gray-500">Created by: {{ $team->creator->name }}</p>
                        @if ($team->pivot)
                            <p class="text-blue-600 font-semibold mt-2">Your Role: {{ ucfirst($team->pivot->role) }}</p>
                        @endif
                        <a href="{{ route('student.challenges.show', $team->challenge) }}" class="text-sm text-indigo-600 underline mt-2 inline-block">
                            View Challenge →
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
