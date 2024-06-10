<?php

namespace App\Domain\Model;

use App\Infrastructure\Persistence\Doctrine\Repository\PaymentNotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentNotificationRepository::class)]
class PaymentNotification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $transactionId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $status;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $notifiedAt;

    // Getters and setters for all properties

    public function getId(): int
    {
        return $this->id;
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function setTransactionId(string $transactionId): self
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getNotifiedAt(): \DateTimeInterface
    {
        return $this->notifiedAt;
    }

    public function setNotifiedAt(\DateTimeInterface $notifiedAt): self
    {
        $this->notifiedAt = $notifiedAt;
        return $this;
    }
}