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
        $url = config('app.url') . '/webhook/asaas';
        $this->execute(
            endpoint: self::API_POST_WEBHOOK,
            method: self::HTTP_METHOD_POST,
            data: [
                'name' => 'Laravel Webhook ' . config('app.name'),
                'url' => $url,
                'email' => config('asaas.webhook_email'),
                'enabled' => true,
                'interrupted' => true,
                'apiVersion' => 3,
                'authToken' => 'Bearer ' . config('asaas.access_token'),
                'sendType' => 'SEQUENTIALLY',
                'events' => [
                    'PAYMENT_CONFIRMED',
                ],

            ]
        );
    }
}
