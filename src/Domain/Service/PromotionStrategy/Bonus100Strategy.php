<?php

namespace App\Domain\Service\PromotionStrategy;

use App\Domain\Model\Payment;

class Bonus100Strategy implements PromotionStrategyInterface
{
    public function apply(Payment $payment): void
    {
        $bonus = 100;
        $payment->setBonusAmount($bonus);
        $payment->setAmount($payment->getAmount() + $bonus);
    }
}