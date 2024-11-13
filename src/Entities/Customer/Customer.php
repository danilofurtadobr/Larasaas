<?php

namespace Dfurtado\Asaas\Entities\Customer;

class Customer
{
    public ?string $id = null;

    public function __construct(
        readonly string $name,
        readonly string $cpfCnpj,
        readonly string $email,
        readonly string $phone,
        readonly string $address,
        readonly string $addressNumber,
        readonly ?string $complement,
        readonly string $province,
        readonly string $postalCode,
        readonly string $externalReference,
        readonly string $company,
    ) {}
}
