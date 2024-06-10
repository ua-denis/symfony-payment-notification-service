<?php

namespace App\Infrastructure\Validator;

use App\Infrastructure\Validator\Contract\PaymentValidatorInterface;
use InvalidArgumentException;

class PaymentValidatorFactory
{
    private array $validatorMap;

    public function __construct(array $validatorMap)
    {
        $this->validatorMap = $validatorMap;
    }

    public function getValidator(string $paymentSystem): PaymentValidatorInterface
    {
        if (!isset($this->validatorMap[$paymentSystem])) {
            throw new InvalidArgumentException(sprintf('Validator for payment system "%s" not found', $paymentSystem));
        }

        return $this->validatorMap[$paymentSystem];
    }
}