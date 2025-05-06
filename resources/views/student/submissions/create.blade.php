@extends('layouts.student')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">

        <h1 class="text-2xl font-bold mb-6">Submit for: {{ $challenge->title }}</h1>

        @if ($existing)
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
                ⚠️ You have already submitted for this challenge.
            </div>
        @endif

        <form method="POST"
              action="{{ route('student.submissions.store', $challenge) }}"
              enctype="multipart/form-data"
              onsubmit="return confirm('Are you sure you want to submit this file? You cannot change it afterwards.')">
            @csrf

            <label for="file" class="block font-medium mb-2">Upload your deliverable (PDF or ZIP)</label>
            <input type="file" name="file" id="file" required class="mb-4">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Upload Submission
            </button>
        </form>
    </div>
@endsection
