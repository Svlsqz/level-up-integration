@extends('layouts.student')

@section('content')
    <div class="max-w-2xl mx-auto py-8 px-4">

        <h1 class="text-2xl font-bold mb-6">Create a New Team</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('student.teams.store') }}">
            @csrf

            {{-- Team Name --}}
            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Team Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            {{-- Entity ID --}}
            <div class="mb-4">
                <label for="entity_id" class="block font-medium mb-1">Entity ID</label>
                <select name="entity_id" id="entity_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="" disabled selected>Select an Entity</option>
                    @foreach ($entities as $entity)
                        <option value="{{ $entity->id }}" {{ old('entity_id') == $entity->id ? 'selected' : '' }}>
                            {{ $entity->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            {{-- Submit --}}
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Create Team
                </button>
            </div>
        </form>

    </div>
@endsection
