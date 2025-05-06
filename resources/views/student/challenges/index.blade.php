@extends('layouts.student')

@section('content')
    <div class="w-full mx-auto py-8 px-6">
    <h1 class="text-3xl font-bold mb-6">Available Challenges</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($challenges as $challenge)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $challenge->title }}</h2>
                    <p class="text-gray-600 text-sm mb-2">
                        Deadline: {{ \Carbon\Carbon::parse($challenge->deadline)->format('F j, Y') }}
                    </p>
                    <p class="text-gray-700 mb-2">
                        {{ Str::limit($challenge->description, 120) }}
                    </p>

                    <a href="{{ route('student.challenges.show', $challenge) }}"
                       class="inline-block mt-2 text-sm font-semibold text-blue-600 hover:underline">
                        View Details →
                    </a>
                </div>
            @empty
                <p class="text-gray-600 col-span-full">No challenges available right now.</p>
            @endforelse
        </div>
    </div>
@endsection
