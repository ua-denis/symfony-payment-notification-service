<?php

namespace App\Infrastructure\Service\PaymentProcessor;

use App\Infrastructure\Service\PaymentProcessor\Contract\PaymentProcessorInterface;

class ThreePayProcessor implements PaymentProcessorInterface
{
    public function process(array $data): bool
    {
        if (in_array($data['status'], ['processing', 'completed'])) {
            return true;
        }

        return false;
    }
}