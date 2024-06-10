<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Model\PaymentNotification;
use App\Domain\Repository\PaymentNotificationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PaymentNotificationRepository extends ServiceEntityRepository implements PaymentNotificationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentNotification::class);
    }

    public function save(PaymentNotification $notification): void
    {
        $this->_em->persist($notification);
        $this->_em->flush();
    }

    public function findByTransactionId(string $transactionId): ?PaymentNotification
    {
        return $this->createQueryBuilder('pn')
            ->andWhere('pn.transactionId = :transactionId')
            ->setParameter('transactionId', $transactionId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findRecentNotifications(\DateTimeInterface $since): array
    {
        return $this->createQueryBuilder('pn')
            ->andWhere('pn.notifiedAt >= :since')
            ->setParameter('since', $since)
            ->orderBy('pn.notifiedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}