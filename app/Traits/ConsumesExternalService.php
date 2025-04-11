<?php

namespace App\Traits;

// Include the Guzzle Component Library
use GuzzleHttp\Client;

trait ConsumesExternalService
{
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
    {
    $client = new Client(['base_uri' => $this->baseUri]);

    
    if (isset($this->secret)) {
        $headers['Authorization'] = $this->secret;
    }

    $response = $client->request($method, $requestUrl, [
        'form_params' => $form_params,
        'headers' => $headers,
    ]);

    // Decode JSON before returning
    return json_decode($response->getBody()->getContents(), true);
}

}