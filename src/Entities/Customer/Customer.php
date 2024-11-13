<?php

namespace Dfurtado\Asaas\Entities\Customer;

class Customer
{
    public ?string $id = null;

    public function __construct(
        readonly ?string $name = null,
        readonly ?string $cpfCnpj = null,
        readonly ?string $email = null,
        readonly ?string $phone = null,
        readonly ?string $address = null,
        readonly ?string $addressNumber = null,
        readonly ?string $complement = null,
        readonly ?string $province = null,
        readonly ?string $postalCode = null,
        readonly ?string $externalReference = null,
        readonly ?string $company = null,
    ) {}
}
