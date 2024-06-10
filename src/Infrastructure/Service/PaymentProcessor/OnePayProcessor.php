<?php

namespace App\Infrastructure\Service\PaymentProcessor;

use App\Infrastructure\Service\PaymentProcessor\Contract\PaymentProcessorInterface;

class OnePayProcessor implements PaymentProcessorInterface
{
    public function process(array $data): bool
    {
        if (in_array($data['status'], ['complete', 'pending', 'refunded'])) {
            return true;
        }

        return false;
    }
}