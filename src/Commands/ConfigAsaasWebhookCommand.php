<?php

namespace Dfurtado\Asaas\Commands;

use Dfurtado\Asaas\Actions\ConfigWebhook;
use Illuminate\Console\Command;

class ConfigAsaasWebhookCommand extends Command
{
    protected $signature = 'asaas:config-webhook';
    protected $description = 'Configura o webhook do Asaas';

    public function handle()
    {
        $this->info('Configurando webhook do Asaas...');
        new ConfigWebhook();
        $this->info('Webhook configurado com sucesso!');
    }
}
