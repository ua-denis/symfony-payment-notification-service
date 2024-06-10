<?php

namespace App\UserInterface\Controller;

use App\Infrastructure\Service\PaymentNotificationHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentNotificationController extends AbstractController
{
    private PaymentNotificationHandler $notificationHandler;

    public function __construct(PaymentNotificationHandler $notificationHandler)
    {
        $this->notificationHandler = $notificationHandler;
    }

    #[Route('/payment/notification', name: 'handle_payment_notification', methods: ['POST'])]
    public function handleNotification(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->notificationHandler->handleNotification($data);
            return new Response('Notification processed successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return new Response('Failed to process notification: '.$e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}