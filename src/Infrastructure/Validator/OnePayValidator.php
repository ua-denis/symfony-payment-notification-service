<?php

namespace App\Infrastructure\Validator;

use App\Infrastructure\Validator\Contract\PaymentValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OnePayValidator implements PaymentValidatorInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($data): ConstraintViolationListInterface
    {
        $constraints = new Assert\Collection([
            'transactionId' => new Assert\NotBlank(),
            'userOrderId' => new Assert\NotBlank(),
            'amount' => new Assert\NotBlank(),
            'currency' => new Assert\NotBlank(),
            'status' => new Assert\Choice(['choices' => ['complete', 'pending', 'refunded']]),
            'orderCreatedAt' => new Assert\NotBlank(),
            'orderCompleteAt' => new Assert\NotBlank(),
            'refundedAmount' => new Assert\NotBlank(),
            'provisionAmount' => new Assert\NotBlank(),
            'hash' => new Assert\NotBlank(),
            'email' => new Assert\Email(),
            'paymentMethod' => new Assert\NotBlank(),
            'paymentMethodGroup' => new Assert\NotBlank(),
            'isCash' => new Assert\Choice(['choices' => ['0', '1']]),
            'sendPush' => new Assert\Choice(['choices' => ['0', '1']]),
            'processingTime' => new Assert\NotBlank(),
        ]);

        return $this->validator->validate($data, $constraints);
    }
}