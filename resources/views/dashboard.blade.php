<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Panel de Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Retos disponibles -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Retos</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">Explora los desafíos disponibles y participa.</p>
                <a href="{{ route('student.challenges.index') }}" class="mt-4 inline-block text-indigo-600 hover:underline">Ver equipos por reto</a>

            </div>

            <!-- Equipos -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Mi equipo</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">Gestiona tu equipo y revisa tu participación.</p>
                <a href="{{ route('student.challenge-teams.index') }}" class="mt-4 inline-block text-indigo-600 hover:underline">Ver equipo</a>
            </div>

            <!-- Progreso -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Mi progreso</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">Consulta tus puntos, niveles y logros.</p>
                <a href="{{ route('leaderboard') }}" class="mt-4 inline-block text-indigo-600 hover:underline">Ver progreso</a>
            </div>

        </div>
    </div>
</x-app-layout>
