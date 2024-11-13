<?php

namespace Dfurtado\Asaas\Entities\Payment;

use Dfurtado\Asaas\Entities\Customer\Customer;

class Payment
{
    public ?BillingType $billingType = null;

    public function __construct(
        readonly string $remoteIp,
        public Customer $customer,
        readonly float $value,
        readonly string $dueDate,
        readonly CreditCard $creditCard,
        readonly CreditCardHolder $creditCardHolder,
    ) {

    }
}
