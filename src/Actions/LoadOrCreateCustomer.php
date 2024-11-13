<?php

namespace Dfurtado\Asaas\Actions;

use Dfurtado\Asaas\Entities\Customer\Customer;
use Dfurtado\Asaas\Http\GatewayRequest;

class LoadOrCreateCustomer
{
    use GatewayRequest;

    const API_GET_CUSTOMER = '/v3/customers?externalReference=';
    const API_POST_CUSTOMER = '/v3/customers';

    public Customer $customer;

    public function __construct(
        Customer $customer,
    ) {
        $this->customer = $customer;
        $this->handle();
    }

    private function handle(): void
    {
        $endpoint = self::API_GET_CUSTOMER . $this->customer->externalReference;
        $response = $this->execute($endpoint);
        $body = $response->body();
        $data = json_decode($body, true)['data'];
        if (is_array($data) && count($data) > 0) {
            $this->customer = new Customer(
                name: $data[0]['name'],
                cpfCnpj: $data[0]['cpfCnpj'],
                email: $data[0]['email'],
                phone: $data[0]['phone'],
                address: $data[0]['address'],
                addressNumber: $data[0]['addressNumber'],
                complement: $data[0]['complement'],
                province: $data[0]['province'],
                postalCode: $data[0]['postalCode'],
                externalReference: $data[0]['externalReference'],
                company: $data[0]['company'],
            );
            $this->customer->id = $data[0]['id'];
        } else {
            $this->createCustomer();
        }
    }

    private function createCustomer(): void
    {
        $endpoint = self::API_POST_CUSTOMER;
        $response = $this->execute(
            endpoint: $endpoint,
            method: self::HTTP_METHOD_POST,
            data: [
                'name' => $this->customer->name,
                'cpfCnpj' => $this->customer->cpfCnpj,
                'email' => $this->customer->email,
                'phone' => $this->customer->phone,
                'address' => $this->customer->address,
                'addressNumber' => $this->customer->addressNumber,
                'province' => $this->customer->province,
                'postalCode' => $this->customer->postalCode,
                'externalReference' => $this->customer->externalReference,
                'company' => $this->customer->company,
        ]);

        $body = $response->body();
        $this->customer->id = json_decode($body, true)['id'];

        if ($response->failed()) {
            throw new \Exception('Erro ao criar o cliente: ' . $response->body());
        }
    }
}
