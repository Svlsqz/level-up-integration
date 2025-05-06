<x-filament::page>
    <h2 class="text-2xl font-bold mb-6">🏆 Leaderboard General</h2>

    <div class="flex gap-3 mb-6">
        <x-filament::button
            wire:click="$set('tab', 'universities')"
            :color="$tab === 'universities' ? 'warning' : 'gray'"
            size="sm"
        >
            Universidades
        </x-filament::button>

        <x-filament::button
            wire:click="$set('tab', 'students')"
            :color="$tab === 'student' ? 'warning' : 'gray'"
            size="sm"
        >
            Estudiantes
        </x-filament::button>
    </div>

    @if ($tab === 'universities')
        <div class="w-full mb-8">
            <div class="overflow-auto shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="w-full min-w-[600px] divide-y divide-gray-200 dark:divide-gray-700 outline-none focus:outline-none">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">Universidad</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">XP Total</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">Estudiantes</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($this->universities as $index => $uni)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-200">{{ $uni->name }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $uni->total_xp }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $uni->students_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No hay universidades registradas.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @elseif ($tab === 'student')
        <div class="w-full mb-8">
            <div class="overflow-auto shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="w-full min-w-[600px] divide-y divide-gray-200 dark:divide-gray-700 outline-none focus:outline-none">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">Estudiante</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">XP</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">Nivel</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($this->students as $index => $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-200">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-yellow-600 dark:text-yellow-300 font-semibold">{{ $user->getPoints() }} XP</td>
                            <td class="px-6 py-4 text-indigo-600 dark:text-indigo-300 font-semibold">Nivel {{ $user->getLevel() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No hay estudiantes registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-filament::page>
