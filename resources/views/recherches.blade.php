<!-- resources/views/recherches.blade.php -->

<x-main-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Tiroir de filtres -->
        <div class="mb-6">
            <button 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="button"
                onclick="toggleFilterDrawer()"
            >
                Afficher les filtres
            </button>
            <div id="filter-drawer" class="hidden mt-4 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <form method="GET" action="{{ url('recherches') }}" onsubmit="return validateFilters()">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Classe d'infraction -->
                        <div>
                            <label for="classe" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Classe d'infraction</label>
                            <input 
                                type="text" 
                                id="classe" 
                                name="classe" 
                                value="{{ request('classe') }}" 
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>

                        <!-- Année -->
                        <div>
                            <label for="annee" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Année</label>
                            <input 
                                type="text" 
                                id="annee" 
                                name="annee" 
                                value="{{ request('annee') }}" 
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>

                        <!-- Département -->
                        <div>
                            <label for="departement" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Département</label>
                            <input 
                                type="text" 
                                id="departement" 
                                name="departement" 
                                value="{{ request('departement') }}" 
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>

                        <!-- Région -->
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Région</label>
                            <input 
                                type="text" 
                                id="region" 
                                name="region" 
                                value="{{ request('region') }}" 
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>

                        <!-- Faits -->
                        <div>
                            <label for="faits" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Faits</label>
                            <input 
                                type="text" 
                                id="faits" 
                                name="faits" 
                                value="{{ request('faits') }}" 
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>

                        <!-- Population -->
                        <div>
                            <label for="population" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Population</label>
                            <input 
                                type="text" 
                                id="population" 
                                name="population" 
                                value="{{ request('population') }}" 
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            />
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button 
                            type="submit" 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Appliquer les filtres
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des infractions -->
        <div class="grid md:grid-cols-1 gap-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Liste des infractions
                    </h3>
                </div>
                <div class="px-6 py-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Classe
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Année
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Département
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Région
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Faits
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Population
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($reponseData['data'] as $crime)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $crime['classe'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        20{{ $crime['annee'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">({{ $crime['Code.département'] }})</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">({{ $crime['Code.région'] }})</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $crime['faits'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ number_format($crime['POP'], 0, ',', ' ') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        @if(isset($reponseData['links']['prev']))
                            <a href="{{ url('recherches?page=' . ($reponseData['meta']['page'] - 1)) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Page précédente
                            </a>
                        @endif
                        @if(isset($reponseData['links']['next']))
                            <a href="{{ url('recherches?page=' . ($reponseData['meta']['page'] + 1)) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Page suivante
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFilterDrawer() {
            const drawer = document.getElementById('filter-drawer');
            drawer.classList.toggle('hidden');
        }

        function validateFilters() {
            const filters = ['classe', 'annee', 'departement', 'region', 'faits', 'population'];
            let hasValue = false;

            for (const filter of filters) {
                const value = document.getElementById(filter).value.trim();
                if (value) {
                    hasValue = true;
                    break;
                }
            }

            if (!hasValue) {
                alert('Veuillez remplir au moins un filtre avant de soumettre.');
                return false;
            }
            return true;
        }
    </script>
</x-main-layout>