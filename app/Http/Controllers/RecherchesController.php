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
        $params = [];
        
        if ($request->classe) {
            $params['classe__contains'] = $request->classe;
        }
        if ($request->annee_min) {
            $params['annee__greater'] = substr($request->annee_min, -2);
        }
        if( $request->annee_max){
            $params['annee__less'] = substr($request->annee_max, -2);
        }
        if ($request->departement) {
            $params['Code.département__contains'] = $request->departement;
        }
        if ($request->region) {
            $params['Code.région__contains'] = $request->region;
        }
        
        $params['page'] = $request->get('page', 1);

        $reponse = Http::withOptions([
            'verify' => false,
        ])->get('https://tabular-api.data.gouv.fr/api/resources/acc332f6-92be-42af-9721-f3609bea8cfc/data/', $params);

        $reponseData = $reponse->json();

        return view('recherches', compact('reponseData'));
    }
}