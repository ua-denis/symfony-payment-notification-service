<?php

namespace App\Domain\Repository;

use App\Domain\Model\Payment;

interface PaymentRepositoryInterface
{
    public function save(Payment $payment): void;
}