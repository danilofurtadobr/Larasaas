<?php

namespace Dfurtado\Asaas\Entities\Payment;

class CreditCard
{
    public function __construct(
        readonly string $holderName,
        readonly string $number,
        readonly string $expiryMonth,
        readonly string $expiryYear,
        readonly string $ccv
    ) {}
}
