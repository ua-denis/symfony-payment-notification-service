<?php

namespace App\Domain\Service;

use App\Domain\Model\Payment;
use App\Domain\Service\PromotionStrategy\PromotionStrategyInterface;
use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class PromotionCodeService
{
    private ContainerInterface $strategyContainer;

    public function __construct(ContainerInterface $strategyContainer)
    {
        $this->strategyContainer = $strategyContainer;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function applyPromotionCode(Payment $payment, string $promoCode): void
    {
        if (!$this->strategyContainer->has($promoCode)) {
            throw new InvalidArgumentException('Promotion code not found');
        }

        $strategy = $this->strategyContainer->get($promoCode);
        if (!$strategy instanceof PromotionStrategyInterface) {
            throw new InvalidArgumentException('Invalid strategy provided');
        }

        $strategy->apply($payment);
    }
}