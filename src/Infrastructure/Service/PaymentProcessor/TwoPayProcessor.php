<?php

namespace App\Infrastructure\Service\PaymentProcessor;

use App\Infrastructure\Service\PaymentProcessor\Contract\PaymentProcessorInterface;

class TwoPayProcessor implements PaymentProcessorInterface
{
    public function process(array $data): bool
    {
        if (in_array($data['state'], [2, 3, 4], true)) {
            return true;
        }

        return false;
    }
}