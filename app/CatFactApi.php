<?php

namespace App;

use GuzzleHttp\Client;

class CatFactApi
{
    const API_URL = 'https://catfact.ninja/fact';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false,
        ]);
    }

    public function fetchRandomFact(): ?string
    {
        $response = $this->client->get($this::API_URL);

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $data = json_decode((string)$response->getBody());

        return $data->fact;
    }
}