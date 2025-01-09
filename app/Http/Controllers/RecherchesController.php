<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\GeoService;

class RecherchesController extends Controller
{
    protected $geoService;

    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }

    public function index(Request $request)
    {
        // Récupérer le numéro de page depuis la requête
        $currentPage = $request->get('page', 1);

        // Appel à l'API avec la page demandée
        $reponse = Http::withOptions([
            'verify' => false,
        ])->get('https://tabular-api.data.gouv.fr/api/resources/acc332f6-92be-42af-9721-f3609bea8cfc/data/?page_size=50');

        // Récupérer les données et les métadonnées de pagination
        $reponseData = $reponse->json();
        
        // Enrichir les données avec les nom des départements et régions
        $enrichedData = $this->geoService->enrichData($reponseData['data'] ?? []);

        return view('recherches', compact('enrichedData'));
    }
}