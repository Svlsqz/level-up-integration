@extends('layouts.student')

@section('content')
    <div class="w-full px-6 py-8">

        <h1 class="text-3xl font-bold mb-4">{{ $challenge->title }}</h1>

        {{-- Fecha límite --}}
        <p class="text-gray-700 mb-2">
            <strong>Deadline:</strong> {{ $challenge->deadline }}
        </p>

        {{-- Descripción --}}
        <p class="text-gray-700 mb-6">
            {{ $challenge->description }}
        </p>

        {{-- Recompensa XP --}}
        <p class="text-indigo-700 font-semibold mb-2">
            🎯 <strong>XP Reward:</strong> {{ $challenge->xp_reward }} XP
        </p>

        {{-- Descripción de recompensa adicional --}}
        @if ($challenge->reward_description)
            <p class="text-green-700 font-medium mb-4">
                🏆 <strong>Additional Rewards:</strong> {{ $challenge->reward_description }}
            </p>
        @endif

        {{-- Archivo descargable --}}
        @if ($challenge->attachment_path)
            <a href="{{ asset('storage/' . $challenge->attachment_path) }}"
               target="_blank"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                📄 Download Challenge Brief
            </a>
        @endif

        <hr class="my-6">

        {{-- Entregable existente --}}
        @if ($submission)
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                ✅ <strong>You already submitted:</strong><br>
                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="underline text-blue-600">
                    📄 Download Submitted File
                </a>
                <p class="mt-2 text-sm">Status: <span class="font-semibold">{{ ucfirst($submission->status) }}</span></p>
            </div>
        @elseif ($team)
            {{-- Si aún no ha entregado --}}
            <a href="{{ route('student.submissions.create', $challenge) }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                🚀 Submit Deliverable
            </a>
        @else
            <p class="text-red-600 font-medium mt-4">
                ⚠️ You must be part of a team to submit a deliverable.
            </p>
        @endif

        @if (!$team)
            <div class="mt-6">
                <a href="{{ route('student.challenge-teams.create', $challenge) }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded">
                    🧑‍🤝‍🧑 Create Team for this Challenge
                </a>
            </div>
        @endif

    </div>
@endsection
