<?php

namespace App\Infrastructure\Service\PaymentProcessor\Contract;

interface PaymentProcessorInterface
{
    public function process(array $data): bool;
}