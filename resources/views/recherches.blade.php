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
                            <select id="classe" name="classe" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Sélectionner une classe</option>
                                <option value="Autres coups et blessures volontaires" {{ request('classe') == 'Autres coups et blessures volontaires' ? 'selected' : '' }}>Autres coups et blessures volontaires</option>
                                <option value="Cambriolages de logement" {{ request('classe') == 'Cambriolages de logement' ? 'selected' : '' }}>Cambriolages de logement</option>
                                <option value="Coups et blessures volontaires" {{ request('classe') == 'Coups et blessures volontaires' ? 'selected' : '' }}>Coups et blessures volontaires</option>
                                <option value="Coups et blessures volontaires intrafamiliaux" {{ request('classe') == 'Coups et blessures volontaires intrafamiliaux' ? 'selected' : '' }}>Coups et blessures volontaires intrafamiliaux</option>
                                <option value="Destructions et dégradations volontaires" {{ request('classe') == 'Destructions et dégradations volontaires' ? 'selected' : '' }}>Destructions et dégradations volontaires</option>
                                <option value="Escroqueries" {{ request('classe') == 'Escroqueries' ? 'selected' : '' }}>Escroqueries</option>
                                <option value="Homicides" {{ request('classe') == 'Homicides' ? 'selected' : '' }}>Homicides</option>
                                <option value="Trafic de stupéfiants" {{ request('classe') == 'Trafic de stupéfiants' ? 'selected' : '' }}>Trafic de stupéfiants</option>
                                <option value="Usage de stupéfiants" {{ request('classe') == 'Usage de stupéfiants' ? 'selected' : '' }}>Usage de stupéfiants</option>
                                <option value="Vols avec armes" {{ request('classe') == 'Vols avec armes' ? 'selected' : '' }}>Vols avec armes</option>
                                <option value="Vols dans les véhicules" {{ request('classe') == 'Vols dans les véhicules' ? 'selected' : '' }}>Vols dans les véhicules</option>
                                <option value="Vols de véhicules" {{ request('classe') == 'Vols de véhicules' ? 'selected' : '' }}>Vols de véhicules</option>
                                <option value="Vols d'accessoires sur véhicules" {{ request('classe') == 'Vols d\'accessoires sur véhicules' ? 'selected' : '' }}>Vols d'accessoires sur véhicules</option>
                                <option value="Vols sans violence contre des personnes" {{ request('classe') == 'Vols sans violence contre des personnes' ? 'selected' : '' }}>Vols sans violence contre des personnes</option>
                                <option value="Vols violents sans arme" {{ request('classe') == 'Vols violents sans arme' ? 'selected' : '' }}>Vols violents sans arme</option>
                                <option value="Violences sexuelles" {{ request('classe') == 'Violences sexuelles' ? 'selected' : '' }}>Violences sexuelles</option>
                            </select>
                         </div>

                        <!-- Années-->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <!-- Année minimum-->
                                <label for="annee_min" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Année min</label>
                                <input 
                                    type="number" 
                                    id="annee_min" 
                                    name="annee_min" 
                                    value="{{ request('annee_min') }}"
                                    min="2016" 
                                    max="2023"
                                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                />
                            </div>
                            <div>
                                <!-- Année maximum-->
                                <label for="annee_max" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Année max</label>
                                <input 
                                    type="number" 
                                    id="annee_max" 
                                    name="annee_max" 
                                    value="{{ request('annee_max') }}"
                                    min="2016" 
                                    max="2023"
                                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                />
                            </div>
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
                    </div>

                    <!-- Validation du formulaire de filtre -->
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
                                        Année min
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
                                            <!-- Doublon, remplacer le premier par le nom du département une fois trouvé comment faire -->
                                            <span class="font-medium">{{ $crime['Code.département'] }}</span>
                                            <span class="text-xs text-gray-500">{{ $crime['Code.département'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <div class="flex flex-col">
                                            <!-- Doublon, remplacer le premier par le nom de la région une fois trouvé comment faire -->
                                            <span class="font-medium">{{ $crime['Code.région'] }}</span>
                                            <span class="text-xs text-gray-500">{{ $crime['Code.région'] }}</span>
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
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        <!-- Affichage du bouton uniquement s'il y a une page avant -->
                        @if(isset($reponseData['links']['prev']))
                            <a href="{{ url('recherches?' . http_build_query(array_merge(request()->all(), ['page' => ($reponseData['meta']['page'] - 1)]))) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Page précédente
                            </a>
                        @endif
                        <!-- Affichage du bouton uniquement s'il y a une page après -->
                        @if(isset($reponseData['links']['next']))
                            <a href="{{ url('recherches?' . http_build_query(array_merge(request()->all(), ['page' => ($reponseData['meta']['page'] + 1)]))) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Page suivante
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Affichage du formulaire
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

            //Impossible de soumettre le formulaire sans avoir complété au moins un champ
            if (!hasValue) {
                alert('Veuillez remplir au moins un filtre avant de soumettre.');
                return false;
            }
            return true;
        }
    </script>
</x-main-layout>