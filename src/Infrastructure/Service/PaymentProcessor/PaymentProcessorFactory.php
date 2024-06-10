<?php

namespace App\Infrastructure\Service\PaymentProcessor;

use App\Infrastructure\Service\PaymentProcessor\Contract\PaymentProcessorInterface;
use InvalidArgumentException;

class PaymentProcessorFactory
{
    private array $processorMap;

    public function __construct(array $processorMap)
    {
        $this->processorMap = $processorMap;
    }

    public function getProcessor(string $paymentSystem): PaymentProcessorInterface
    {
        if (!isset($this->processorMap[$paymentSystem])) {
            throw new InvalidArgumentException(sprintf('Processor for payment system "%s" not found', $paymentSystem));
        }

        return $this->processorMap[$paymentSystem];
    }
}