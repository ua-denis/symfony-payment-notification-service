<?php

namespace App\Domain\Repository;

use App\Domain\Model\PaymentNotification;
use DateTimeInterface;

interface PaymentNotificationRepositoryInterface
{
    public function save(PaymentNotification $notification): void;

    public function findByTransactionId(string $transactionId): ?PaymentNotification;

    public function findRecentNotifications(DateTimeInterface $since): array;
}