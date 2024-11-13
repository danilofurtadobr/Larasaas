<?php

namespace Dfurtado\Asaas\Http\Controllers;

use Dfurtado\Asaas\Actions\CreatePaymentCreditCard;
use Dfurtado\Asaas\Actions\LoadOrCreateCustomer;
use Dfurtado\Asaas\Entities\Customer\Customer;
use Dfurtado\Asaas\Entities\Payment\BillingType;
use Dfurtado\Asaas\Entities\Payment\Payment;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class AsaasController extends Controller
{
    protected function generatePaymentCreditCard(Payment $payment)
    {
        $payment->customer = (new LoadOrCreateCustomer($payment->customer))->customer;
        $payment->billingType = BillingType::CREDIT_CARD;
        return new CreatePaymentCreditCard($payment);
    }

    public function paymentsWebhook()
    {
        $body = request()->all();

        switch ($body['event']) {
            case 'PAYMENT_CONFIRMED ':
                $customer = new Customer();
                $customer->id = $body['payment']['customer']['name'];
                $customer = (new LoadOrCreateCustomer($customer))->customer;
                $payment = new Payment(
                    $customer,
                    $body['payment']['value'],
                    $body['payment']['dueDate'],
                    $body['payment']['installmentCount'],
                    $body['payment']['installmentValue'],
                    $body['payment']['totalValue'],
                );
                $this->confirmePayment($payment);
                break;
            default:
                echo "Este evento não é aceito {$body['event']}";
        }

        return response()->json(['received' => true]);
    }

    protected function confirmePayment(Payment $payment)
    {
        Log::info('Pagamento confirmado', $payment->customer->externalReference);
    }
}
