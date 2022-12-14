<?php

namespace HOTSAUCEJAKE\LaravelSleeper\Traits;

use GuzzleHttp\Client;

trait MakesHttpRequests
{
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri ?? null,
        ]);

        $response = $client->request($method, $requestUrl, [
            'query' => $queryParams,
            'form_params' => $formParams,
            'headers' => $headers,
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
