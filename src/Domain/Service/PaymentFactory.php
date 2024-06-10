<?php

namespace App\Domain\Service;

use App\Domain\Model\Payment;
use DateTime;
use Exception;

class PaymentFactory
{
    /**
     * @throws Exception
     */
    public function create(array $data): Payment
    {
        $payment = new Payment();
        $payment->setTransactionId($data['transactionId']);
        $payment->setUserOrderId($data['userOrderId']);
        $payment->setAmount($data['amount']);
        $payment->setCurrency($data['currency']);
        $payment->setStatus($data['status']);
        $payment->setOrderCreatedAt(new DateTime($data['orderCreatedAt']));
        $payment->setOrderCompleteAt(new DateTime($data['orderCompleteAt']));
        $payment->setEmail($data['email'] ?? null);
        $payment->setPaymentMethod($data['paymentMethod']);
        $payment->setPaymentMethodGroup($data['paymentMethodGroup']);
        $payment->setIsCash($data['isCash']);
        $payment->setSendPush($data['sendPush']);
        $payment->setProcessingTime($data['processingTime']);

        return $payment;
    }
}