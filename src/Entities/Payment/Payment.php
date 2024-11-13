<?php

namespace Dfurtado\Asaas\Entities\Payment;

use Dfurtado\Asaas\Entities\Customer\Customer;

class Payment
{
    public ?BillingType $billingType = null;
    public string $remoteIp;
    public CreditCard $creditCard;
    public CreditCardHolder $creditCardHolder;

    public function __construct(
        public Customer $customer,
        readonly float $value,
        readonly string $dueDate,
        readonly int $installmentCount = 1, 
    ) {

    }
}
