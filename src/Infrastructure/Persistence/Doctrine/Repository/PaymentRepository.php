<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Model\Payment;
use App\Domain\Repository\PaymentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PaymentRepository extends ServiceEntityRepository implements PaymentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function save(Payment $payment): void
    {
        $this->_em->persist($payment);
        $this->_em->flush();
    }
}