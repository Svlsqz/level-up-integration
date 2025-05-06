@extends('layouts.student')

@section('content')
    <div class="max-w-xl mx-auto py-8 px-4">

        <h1 class="text-2xl font-bold mb-6">Create Team for: {{ $challenge->title }}</h1>

        <form method="POST" action="{{ route('student.challenge-teams.store', $challenge) }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Team Name</label>
                <input type="text" name="name" id="name"
                       class="w-full border px-3 py-2 rounded" required>
                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                ✅ Create Team
            </button>
        </form>

    </div>
@endsection
