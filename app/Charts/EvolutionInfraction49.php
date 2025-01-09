<?php 

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\Http;

class EvolutionInfraction49 extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $labels = [];
        $data = [];

        for($year = 16; $year <= 23; $year++) {
            $response = Http::withOptions([
                'verify' => false,
            ])->get('https://tabular-api.data.gouv.fr/api/resources/acc332f6-92be-42af-9721-f3609bea8cfc/data/', [
                'Code.département__contains' => '49',
                'annee__less' => $year,
                'annee__greater' => $year,
            ]);
            
            $yearData = $response->json();

            $totalInfractions = array_reduce($yearData['data'], function($carry, $item) {
                return $carry + $item['faits'];
            }, 0);
            
            $labels[] = "20$year";
            $data[] = $totalInfractions;
        }

        $this->labels($labels);
        $this->dataset('Nombre d\'infractions', 'line', $data)
            ->backgroundColor('rgba(37, 99, 235, 0.2)')
            ->color('rgb(37, 99, 235)');
    }
}