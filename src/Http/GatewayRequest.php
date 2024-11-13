<?php

namespace Dfurtado\Asaas\Http;

use Illuminate\Support\Facades\Http;

trait GatewayRequest
{
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';

    private function execute(
        string $endpoint,
        array $headers = [],
        string $method = self::HTTP_METHOD_GET,
        array $data = [],
        array $cookies = []
    ): \Illuminate\Http\Client\Response {
        $accessToken = config('asaas.access_token', 'default_access_token');

        $headers = array_merge($headers, [
            'access_token' => $accessToken, 
            'Content-Type' => 'application/json',
        ]);

        $baseUri = config('asaas.base_uri', 'https://sandbox.asaas.com/api');

        $request = Http::withHeaders($headers)
            ->withCookies($cookies, $baseUri);

        if ($method === self::HTTP_METHOD_POST) {
            $response = $request->post($baseUri . $endpoint, $data);
        } else {
            $response = $request->get($baseUri . $endpoint);
        }

        if ($response->failed() && $response->status() !== 404) {
            throw new \Exception(sprintf(
                "Erro ao fazer a requisição: %s\nStatus Code: %d\nResponse Body: %s",
                $response->reason(),
                $response->status(),
                $response->body()
            ));
        }

        return $response;
    }
}