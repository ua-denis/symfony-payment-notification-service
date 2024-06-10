<?php

namespace App\Domain\Service\PromotionStrategy;

use App\Domain\Model\Payment;

interface PromotionStrategyInterface
{
    public function apply(Payment $payment): void;
}