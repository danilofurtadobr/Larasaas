<?php

namespace Dfurtado\Asaas;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class AsaasServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Log::info('AsaasServiceProvider booted');
    }

    public function register()
    {
    }
}
