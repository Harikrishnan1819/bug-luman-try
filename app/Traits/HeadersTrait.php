<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait HeadersTrait
{

    private $baseURL = 'https://api.bugatlas.com/v1';

    /**
     * Process API response.
     *
     * @param  string  $endPoint
     * @param  array  $body
     * @return mixed
     */
    public function processApiResponse($endPoint, $body)
    {
        $client = new Client();
    
        try {
            $response = $client->post($this->baseURL . $endPoint, [
                'headers' => $this->getApiHeaders(),
                'json' => $body,
            ]);
    
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            return $e->getMessage();
        }
    }


    /**
     * Get API headers.
     *
     * @return array
     */
    private function getApiHeaders()
    {
        return [
            'api_key' => env('API_KEY'),
            'secret_key' => env('SECRET_KEY'),
            'Content-Type' => 'application/json'
        ];
    }
}

