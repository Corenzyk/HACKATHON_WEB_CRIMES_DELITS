<?php

namespace App\Http\Controllers;

use App\Charts\EvolutionInfraction49;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChartController extends Controller
{
    public function index(Request $request)
    {    
        $reponse = Http::withOptions([
            'verify' => false,
        ])->get('https://tabular-api.data.gouv.fr/api/resources/acc332f6-92be-42af-9721-f3609bea8cfc/data/');

        $reponseData = $reponse->json();
        
        $chart = new EvolutionInfraction49;
        
        return view('statistiques', compact('reponseData', 'chart'));
    }

}
