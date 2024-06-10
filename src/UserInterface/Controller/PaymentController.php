<?php

namespace App\UserInterface\Controller;

use App\Application\UseCase\ProcessPaymentUseCase;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    private ProcessPaymentUseCase $processPaymentUseCase;

    public function __construct(ProcessPaymentUseCase $processPaymentUseCase)
    {
        $this->processPaymentUseCase = $processPaymentUseCase;
    }

    /**
     * @throws Exception
     */
    #[Route('/payment/{paymentSystem}', name: 'process_payment', methods: ['POST'])]
    public function processPayment(Request $request, string $paymentSystem): Response
    {
        $data = json_decode($request->getContent(), true);
        $promoCode = $request->headers->get('X-Promo-Code');

        if ($this->processPaymentUseCase->execute($paymentSystem, $data, $promoCode)) {
            return new Response('Payment processed successfully', Response::HTTP_OK);
        }

        return new Response('Failed to process payment', Response::HTTP_BAD_REQUEST);
    }
}