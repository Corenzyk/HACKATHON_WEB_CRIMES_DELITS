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
        $response = Http::withOptions([
            'verify' => false,
        ])->get('https://tabular-api.data.gouv.fr/api/resources/acc332f6-92be-42af-9721-f3609bea8cfc/data/', [
            'page' => $currentPage
        ]);
        
        // Récupérer les données et les métadonnées de pagination
        $responseData = $response->json();
        
        // Enrichir les données avec les informations géographiques
        $enrichedData = $this->geoService->enrichData($responseData['data'] ?? []);
        
        // Créer un objet de pagination Laravel personnalisé
        $crimes = new \Illuminate\Pagination\LengthAwarePaginator(
            $enrichedData,                                       // items
            $responseData['total'] ?? 0,                        // total
            $responseData['per_page'] ?? 15,                    // par page
            $currentPage,                                       // page courante
            [
                'path' => $request->url(),
                'query' => $request->query()
            ]
        );
        
        return view('recherches', compact('crimes'));
    }
}