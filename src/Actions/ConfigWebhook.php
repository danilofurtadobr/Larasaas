<?php

namespace Dfurtado\Asaas\Actions;

use Dfurtado\Asaas\Http\GatewayRequest;

class ConfigWebhook
{
    use GatewayRequest;

    const API_POST_WEBHOOK = '/v3/webhooks';

    public function __construct()
    {
        $this->handle();
    }

    public function handle()
    {
        $url = env('APP_URL') . '/webhook/asaas';
        if(env('APP_ENV') === 'local') {
            $url = 'https://www.exemplo.com/webhook/asaas';
        }
        $this->execute(
            endpoint: self::API_POST_WEBHOOK,
            method: self::HTTP_METHOD_POST,
            data: [
                'name' => 'Laravel Webhook ' . env('APP_NAME'),
                'url' => $url,
                'email' => env('ASAAS_WEBHOOK_EMAIL'),
                'enabled' => true,
                'interrupted' => true,
                'apiVersion' => 3,
                'authToken' => 'Bearer ' . env('ASAAS_ACCESS_TOKEN'),
                'sendType' => 'SEQUENTIALLY',
                'events' => [
                    'PAYMENT_CONFIRMED',
                ],

            ]
        );
    }
}
