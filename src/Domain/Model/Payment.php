<?php

namespace App\Domain\Model;

use App\Infrastructure\Persistence\Doctrine\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $transactionId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $userOrderId;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $amount;

    #[ORM\Column(type: 'string', length: 3)]
    private string $currency;

    #[ORM\Column(type: 'string', length: 50)]
    private string $status;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $orderCreatedAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $orderCompleteAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 50)]
    private string $paymentMethod;

    #[ORM\Column(type: 'string', length: 50)]
    private string $paymentMethodGroup;

    #[ORM\Column(type: 'boolean')]
    private bool $isCash;

    #[ORM\Column(type: 'boolean')]
    private bool $sendPush;

    #[ORM\Column(type: 'integer')]
    private int $processingTime;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?float $bonusAmount = null;

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

    public function getUserOrderId(): string
    {
        return $this->userOrderId;
    }

    public function setUserOrderId(string $userOrderId): self
    {
        $this->userOrderId = $userOrderId;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
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

    public function getOrderCreatedAt(): \DateTimeInterface
    {
        return $this->orderCreatedAt;
    }

    public function setOrderCreatedAt(\DateTimeInterface $orderCreatedAt): self
    {
        $this->orderCreatedAt = $orderCreatedAt;
        return $this;
    }

    public function getOrderCompleteAt(): \DateTimeInterface
    {
        return $this->orderCompleteAt;
    }

    public function setOrderCompleteAt(\DateTimeInterface $orderCompleteAt): self
    {
        $this->orderCompleteAt = $orderCompleteAt;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentMethodGroup(): string
    {
        return $this->paymentMethodGroup;
    }

    public function setPaymentMethodGroup(string $paymentMethodGroup): self
    {
        $this->paymentMethodGroup = $paymentMethodGroup;
        return $this;
    }

    public function isCash(): bool
    {
        return $this->isCash;
    }

    public function setIsCash(bool $isCash): self
    {
        $this->isCash = $isCash;
        return $this;
    }

    public function isSendPush(): bool
    {
        return $this->sendPush;
    }

    public function setSendPush(bool $sendPush): self
    {
        $this->sendPush = $sendPush;
        return $this;
    }

    public function getProcessingTime(): int
    {
        return $this->processingTime;
    }

    public function setProcessingTime(int $processingTime): self
    {
        $this->processingTime = $processingTime;
        return $this;
    }

    public function getBonusAmount(): ?float
    {
        return $this->bonusAmount;
    }

    public function setBonusAmount(?float $bonusAmount): self
    {
        $this->bonusAmount = $bonusAmount;
        return $this;
    }
}