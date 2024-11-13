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
        $accessToken = env('ASAAS_ACCESS_TOKEN', 'default_access_token');

        $headers = array_merge($headers, [
            'access_token' => $accessToken, 
            'Content-Type' => 'application/json',
        ]);

        $baseUri = env('ASAAS_BASE_URI', 'https://sandbox.asaas.com/api');

        $request = Http::withHeaders($headers)
            ->withCookies($cookies, $baseUri);

        if ($method === self::HTTP_METHOD_POST) {
            $response = $request->post($baseUri . $endpoint, $data);
        } else {
            $response = $request->get($baseUri . $endpoint);
        }

        if ($response->failed() && $response->status() !== 404) {
            throw new \Exception("Erro ao fazer a requisição: " . $response->body());
        }

        return $response;
    }
}
