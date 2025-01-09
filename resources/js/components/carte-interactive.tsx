import React, { useState } from 'react';
import { ChevronLeft } from 'lucide-react';

// Composant principal
export default function FranceMap() {
    // États pour gérer le niveau de zoom et la sélection
    const [view, setView] = useState('country'); // 'country', 'region', 'department'
    const [selectedRegion, setSelectedRegion] = useState(null);
    const [selectedDepartment, setSelectedDepartment] = useState(null);
    const [details, setDetails] = useState(null);
    const [loading, setLoading] = useState(false);

    // Fonction pour gérer le clic sur une région
    const handleRegionClick = async (regionId) => {
        setLoading(true);
        try {
            const response = await fetch(`https://geo.api.gouv.fr/regions/${regionId}`);
            const data = await response.json();
            setDetails(data);
            setSelectedRegion(regionId);
            setView('region');
        } catch (error) {
            console.error('Erreur lors du chargement des données:', error);
        }
        setLoading(false);
    };

    // Fonction pour gérer le clic sur un département
    const handleDepartmentClick = async (deptId) => {
        setLoading(true);
        try {
            const response = await fetch(`https://geo.api.gouv.fr/departements/${deptId}`);
            const data = await response.json();
            setDetails(data);
            setSelectedDepartment(deptId);
            setView('department');
        } catch (error) {
            console.error('Erreur lors du chargement des données:', error);
        }
        setLoading(false);
    };

    // Fonction pour revenir au niveau précédent
    const handleBack = () => {
        if (view === 'department') {
            setView('region');
            setSelectedDepartment(null);
            // Recharger les détails de la région
            handleRegionClick(selectedRegion);
        } else if (view === 'region') {
            setView('country');
            setSelectedRegion(null);
            setDetails(null);
        }
    };

    return (
        <div className="flex h-screen overflow-hidden">
            {/* Conteneur principal carte + panel */}
            <div className="flex-1 flex">
                {/* Zone de la carte */}
                <div className="flex-1 relative">
                    {/* Bouton retour */}
                    {view !== 'country' && (
                        <button
                            onClick={handleBack}
                            className="absolute top-4 left-4 p-2 bg-white rounded-full shadow-lg hover:bg-gray-100 z-10"
                        >
                            <ChevronLeft className="w-6 h-6" />
                        </button>
                    )}

                    {/* Carte SVG - À remplacer par la vraie carte SVG de la France */}
                    <div className="w-full h-full bg-gray-100">
                        {view === 'country' && (
                            <div className="p-4 text-center">
                                [Carte de France avec régions]
                                {/* Exemple d'une région cliquable */}
                                <button
                                    onClick={() => handleRegionClick('84')}
                                    className="m-2 p-2 bg-blue-100 hover:bg-blue-200 rounded"
                                >
                                    Auvergne-Rhône-Alpes (84)
                                </button>
                            </div>
                        )}
                        {view === 'region' && (
                            <div className="p-4 text-center">
                                [Carte de la région {selectedRegion}]
                                {/* Exemple d'un département cliquable */}
                                <button
                                    onClick={() => handleDepartmentClick('69')}
                                    className="m-2 p-2 bg-green-100 hover:bg-green-200 rounded"
                                >
                                    Rhône (69)
                                </button>
                            </div>
                        )}
                        {view === 'department' && (
                            <div className="p-4 text-center">
                                [Carte du département {selectedDepartment}]
                            </div>
                        )}
                    </div>
                </div>

                {/* Panel d'informations */}
                <div className="w-96 bg-white shadow-lg p-6 overflow-y-auto">
                    {loading ? (
                        <div className="flex items-center justify-center h-full">
                            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900"></div>
                        </div>
                    ) : details ? (
                        <div>
                            <h2 className="text-2xl font-bold mb-4">
                                {view === 'region' ? 'Région' : 'Département'} : {details.name}
                            </h2>
                            <div className="space-y-4">
                                {/* Exemple d'informations à afficher */}
                                <div>
                                    <h3 className="font-semibold text-lg">Population</h3>
                                    <p>{details.population} habitants</p>
                                </div>
                                <div>
                                    <h3 className="font-semibold text-lg">Superficie</h3>
                                    <p>{details.area} km²</p>
                                </div>
                                {/* Ajoutez d'autres informations selon vos besoins */}
                            </div>
                        </div>
                    ) : (
                        <div className="flex items-center justify-center h-full text-gray-500">
                            Sélectionnez une région ou un département pour voir les détails
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}