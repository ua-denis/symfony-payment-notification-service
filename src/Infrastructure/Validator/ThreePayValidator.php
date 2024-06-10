<?php

namespace App\Infrastructure\Validator;

use App\Infrastructure\Validator\Contract\PaymentValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ThreePayValidator implements PaymentValidatorInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($data): ConstraintViolationListInterface
    {
        $constraints = new Assert\Collection([
            'order' => new Assert\NotBlank(),
            'txid' => new Assert\NotBlank(),
            'usdAmount' => new Assert\NotBlank(),
            'status' => new Assert\Choice(['choices' => ['processing', 'completed']]),
        ]);

        return $this->validator->validate($data, $constraints);
    }
}