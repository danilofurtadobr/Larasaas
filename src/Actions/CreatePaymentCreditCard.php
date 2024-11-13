<?php

namespace Dfurtado\Asaas\Actions;

use Dfurtado\Asaas\Entities\Payment\Payment;
use Dfurtado\Asaas\Http\GatewayRequest;

class CreatePaymentCreditCard
{
    use GatewayRequest;

    const API_POST_PAYMENT = '/v3/payments';

    public function __construct(
        readonly Payment $payment
    ) {
        $this->handle();
    }

    private function handle(): string
    {
        $response = $this->execute(
            endpoint: self::API_POST_PAYMENT,
            method: self::HTTP_METHOD_POST,
            data: [
                'customer' => $this->payment->customer->id,
                'billingType' => $this->payment->billingType,
                'value' => $this->payment->value,
                'dueDate' => $this->payment->dueDate,
                'installmentCount' => $this->payment->installmentCount,
                'creditCard' => [
                    'holderName' => $this->payment->creditCard->holderName,
                    'number' => $this->payment->creditCard->number,
                    'expiryMonth' => $this->payment->creditCard->expiryMonth,
                    'expiryYear' => $this->payment->creditCard->expiryYear,
                    'ccv' => $this->payment->creditCard->ccv,
                ],
                'creditCardHolderInfo' => [
                    'name' => $this->payment->creditCardHolder->name,
                    'email' => $this->payment->creditCardHolder->email,
                    'cpfCnpj' => $this->payment->creditCardHolder->cpfCnpj,
                    'postalCode' => $this->payment->creditCardHolder->postalCode,
                    'addressNumber' => $this->payment->creditCardHolder->addressNumber,
                    'addressComplement' => $this->payment->creditCardHolder->addressComplement,
                    'phone' => $this->payment->creditCardHolder->phone,
                ],
                'remoteIp' => $this->payment->remoteIp,
        ]);

        if ($response->failed()) {
            throw new \Exception('Erro ao criar pagamento: ' . $response->body());
        }

        return $response;
    }
}
