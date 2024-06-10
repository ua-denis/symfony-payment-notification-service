<?php

namespace App\Infrastructure\Validator;

use App\Infrastructure\Validator\Contract\PaymentValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TwoPayValidator implements PaymentValidatorInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($data): ConstraintViolationListInterface
    {
        $constraints = new Assert\Collection([
            'identifier' => new Assert\NotBlank(),
            'orderId' => new Assert\NotBlank(),
            'amount' => new Assert\NotBlank(),
            'currency' => new Assert\NotBlank(),
            'state' => new Assert\Choice(['choices' => [2, 3, 4]]),
            'createdAt' => new Assert\NotBlank(),
            'updatedAt' => new Assert\NotBlank(),
            'refundedAmount' => new Assert\NotBlank(),
            'provisionAmount' => new Assert\NotBlank(),
            'hash' => new Assert\NotBlank(),
            'email' => new Assert\Email(),
            'cardMetadata' => new Assert\Collection([
                'bin' => new Assert\NotBlank(),
                'lastDigits' => new Assert\NotBlank(),
                'paymentSystem' => new Assert\NotBlank(),
                'country' => new Assert\NotBlank(),
                'holderName' => new Assert\NotBlank(),
            ]),
        ]);

        return $this->validator->validate($data, $constraints);
    }
}