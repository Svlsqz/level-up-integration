<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Growists Lab') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 font-sans antialiased">
<div class="min-h-screen flex flex-col">

    <!-- Barra de navegación opcional -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-lg font-bold text-indigo-700">
                Growists Lab
            </a>
            <div>
                @auth
                    <a class="text-sm mr-4" href="{{ route('student.profile') }}">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="text-sm text-red-600 hover:underline">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex-grow py-8 px-4 max-w-7xl mx-auto">
        @yield('content')
    </main>

    <!-- Footer opcional -->
    <footer class="bg-gray-200 text-center text-sm text-gray-600 py-4">
        © {{ date('Y') }} Growists Lab — Student Area
    </footer>

</div>
</body>
</html>
