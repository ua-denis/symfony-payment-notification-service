<?php

namespace App\Infrastructure\Validator\Contract;

use Symfony\Component\Validator\ConstraintViolationListInterface;

interface PaymentValidatorInterface
{
    public function validate($data): ConstraintViolationListInterface;
}