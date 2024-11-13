<?php

namespace Dfurtado\Asaas\Entities\Payment;

class CreditCardHolder
{
    public function __construct(
        readonly string $name,
        readonly string $email,
        readonly string $cpfCnpj,
        readonly string $postalCode,
        readonly string $addressNumber,
        readonly ?string $addressComplement,
        readonly string $phone,
    ) {

    }
}
