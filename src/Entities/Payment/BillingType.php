<?php

namespace Dfurtado\Asaas\Entities\Payment;

enum BillingType: string
{
    case BOLETO = 'BOLETO';
    case CREDIT_CARD = 'CREDIT_CARD';
    case PIX = 'PIX';
}
