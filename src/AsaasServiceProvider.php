<?php

namespace Dfurtado\Asaas;

use Dfurtado\Asaas\Http\Controllers\AsaasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AsaasServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            Commands\ConfigAsaasWebhookCommand::class,
        ]);

        Route::post('/webhook/asaas', [AsaasController::class, 'paymentsWebhook']);
    }

    public function register()
    {
    }
}
