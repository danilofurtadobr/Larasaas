<?php

namespace Dfurtado\Asaas\Http\Controllers;

use Dfurtado\Asaas\Actions\CreatePaymentCreditCard;
use Dfurtado\Asaas\Actions\LoadOrCreateCustomer;
use Dfurtado\Asaas\Entities\Payment\BillingType;
use Dfurtado\Asaas\Entities\Payment\Payment;
use Illuminate\Routing\Controller;

abstract class AsaasController extends Controller
{
    protected function generatePaymentCreditCard(Payment $payment)
    {
        $payment->customer = (new LoadOrCreateCustomer($payment->customer))->customer;
        $payment->billingType = BillingType::CREDIT_CARD;
        return new CreatePaymentCreditCard($payment);
    }
}
