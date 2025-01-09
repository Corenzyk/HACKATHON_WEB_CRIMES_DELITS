<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GeoService
{
    private $baseUrl = 'https://geo.api.gouv.fr';
    private $departements = [];
    private $regions = [];

    public function __construct()
    {
        $this->loadGeoData();
    }

    private function loadGeoData()
    {
        // Charger les données depuis le cache ou l'API
        $this->departements = Cache::remember('all_departements', 86400, function () {
            $response = Http::withOptions([
                'verify' => false,
            ])->get("{$this->baseUrl}/departements");

            if ($response->successful()) {
                $data = $response->json();
                return collect($data)->mapWithKeys(function ($item) {
                    return [$item['code'] => $item['nom']];
                })->all();
            }

            return [];
        });

        $this->regions = Cache::remember('all_regions', 86400, function () {
            $response = Http::withOptions([
                'verify' => false,
            ])->get("{$this->baseUrl}/regions");

            if ($response->successful()) {
                $data = $response->json();
                return collect($data)->mapWithKeys(function ($item) {
                    return [$item['code'] => $item['nom']];
                })->all();
            }

            return [];
        });
    }

    public function getDepartementName($code)
    {
        return $this->departements[$code] ?? $code;
    }

    public function getRegionName($code)
    {
        return $this->regions[$code] ?? $code;
    }
}