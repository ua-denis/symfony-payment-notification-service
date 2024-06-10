<?php

namespace App\Infrastructure\Service;

use App\Domain\Model\PaymentNotification;
use App\Domain\Repository\PaymentNotificationRepositoryInterface;

class PaymentNotificationHandler
{
    private PaymentNotificationRepositoryInterface $notificationRepository;

    public function __construct(PaymentNotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function handleNotification(array $data): void
    {
        $notification = new PaymentNotification();
        $notification->setTransactionId($data['transactionId']);
        $notification->setStatus($data['status']);
        $notification->setNotifiedAt(new \DateTime());

        $this->notificationRepository->save($notification);
    }
}