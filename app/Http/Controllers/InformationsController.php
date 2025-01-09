<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationsController extends Controller
{
    public function fetchCrimeData() {

    $response = Http::get('https://tabular-api.data.gouv.fr/api/resources/acc332f6-92be-42af-9721-f3609bea8cfc/data/');

    // Vérification de la réponse
    if ($response->successful()) {
        $data = $response->json();
    } else {
        $data = [];
    }

    return $data;
    }

    public function getSafeDepartments() {
        $crimeData = $this->fetchCrimeData();
    
        // Supposons que $crimeData est un tableau où chaque élément contient un département et son nombre de délits.
        $filteredData = array_filter($crimeData, function ($item) {
            return $item['annee'] == 2022; // Filtrer pour l'année 2022
        });
    
        $sortedData = collect($filteredData)->sortBy('nombre_délits')->toArray();
    
        // Obtenez uniquement les 10 départements les plus sûrs
        $topSafeDepartments = array_slice($sortedData, 0, 10);
    
        return $topSafeDepartments;
    }    
}
