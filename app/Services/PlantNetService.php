<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PlantNetService
{
    protected $apiUrl = 'https://my-api.plantnet.org/v2/species';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('PLANTNET_API_KEY');
    }

    /**
     * Busca uma planta pelo nome e retorna uma imagem dela.
     */
    public function searchPlantImageByName($plantName)
    {
        $response = Http::get($this->apiUrl, [
            'api-key' => $this->apiKey,
            'prefix' => $plantName, // Busca pelo nome da planta
            'lang' => 'pt', // Português
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Verifica se há resultados
            if (!empty($data) && isset($data[0]['id'])) {
                return $data;
            }
        }

        return null; // Retorna null se não encontrar
    }
}
