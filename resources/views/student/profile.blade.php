@extends('layouts.student')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-6 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl shadow-lg border border-blue-100">
        <!-- Header con avatar y nombre -->
        <div class="flex items-center mb-8">
            <div class="relative">
                <div class="w-20 h-20 rounded-full bg-blue-100 border-4 border-blue-300 flex items-center justify-center overflow-hidden">
                    <span class="text-3xl font-bold text-blue-600">{{ substr($student->name, 0, 1) }}</span>
                </div>
                <div class="absolute -bottom-2 -right-2 bg-yellow-400 rounded-full w-8 h-8 flex items-center justify-center text-xs font-bold">
                    {{ $student->level() }}
                </div>
            </div>
            <div class="ml-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $student->name }}</h1>
                <p class="text-blue-600">{{ $student->entity->name ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Barra de progreso de nivel -->
        <div class="mb-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between mb-2">
                <span class="font-semibold text-gray-700">Nivel {{ $student->level() }}</span>
                <span class="font-semibold text-blue-600">{{ $student->totalXPLogged() }} XP</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div
                    class="bg-gradient-to-r from-blue-400 to-indigo-600 h-4 rounded-full"
                    style="width: {{ ($student->totalXPLogged() - $student->xpForCurrentLevel()) / ($student->xpForNextLevel() - $student->xpForCurrentLevel()) * 100 }}%">
                </div>
            </div>
            <div class="text-right text-sm text-gray-500 mt-1">
                {{ $student->xpToNextLevel() }} XP para el siguiente nivel
            </div>
        </div>

        <!-- Sección de información -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Información Básica
                </h2>
                <div class="space-y-2">
                    <p class="flex items-center"><svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> <strong class="text-gray-600">Email:</strong> <span class="ml-1">{{ $student->email }}</span></p>
                </div>
            </div>

            <!-- Estadísticas rápidas -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    Logros
                </h2>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-blue-600">{{ $student->level() }}</div>
                        <div class="text-xs text-gray-500">Nivel</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-green-600">{{ $student->completedActivitiesCount() }}</div>
                        <div class="text-xs text-gray-500">Actividades</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-purple-600">{{ $student->rewards->count() }}</div>
                        <div class="text-xs text-gray-500">Recompensas</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de recompensas -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m8-8v13m-8-13V3m8 8V3m-8 8l-4-4-4 4m8 0l4-4 4 4"></path>
                </svg>
                Recompensas Obtenidas
            </h2>

            @if ($student->rewards->isEmpty())
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aún no tienes recompensas</h3>
                    <p class="mt-1 text-sm text-gray-500">Completa actividades para ganar tus primeras recompensas.</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($student->rewards as $reward)
                        <div class="border rounded-lg p-4 text-center bg-gradient-to-b from-{{ $reward->color }}-50 to-white">
                            <div class="mx-auto w-12 h-12 rounded-full bg-{{ $reward->color }}-100 flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-{{ $reward->color }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                            <h3 class="font-medium text-gray-900">{{ $reward->name }}</h3>
                            <p class="text-xs text-gray-500">{{ $reward->type }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
