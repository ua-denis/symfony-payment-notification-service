<?php

namespace App\Application\UseCase;

use App\Domain\Repository\PaymentRepositoryInterface;
use App\Domain\Service\PaymentFactory;
use App\Domain\Service\PromotionCodeService;
use App\Infrastructure\Service\PaymentProcessor\PaymentProcessorFactory;
use App\Infrastructure\Validator\PaymentValidatorFactory;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProcessPaymentUseCase
{
    private PaymentProcessorFactory $paymentProcessorFactory;
    private PaymentValidatorFactory $paymentValidatorFactory;
    private PaymentRepositoryInterface $paymentRepository;
    private ValidatorInterface $validator;
    private PaymentFactory $paymentFactory;
    private PromotionCodeService $promotionCodeService;

    public function __construct(
        PaymentProcessorFactory $paymentProcessorFactory,
        PaymentValidatorFactory $paymentValidatorFactory,
        PaymentRepositoryInterface $paymentRepository,
        ValidatorInterface $validator,
        PaymentFactory $paymentFactory,
        PromotionCodeService $promotionCodeService
    ) {
        $this->paymentProcessorFactory = $paymentProcessorFactory;
        $this->paymentValidatorFactory = $paymentValidatorFactory;
        $this->paymentRepository = $paymentRepository;
        $this->validator = $validator;
        $this->paymentFactory = $paymentFactory;
        $this->promotionCodeService = $promotionCodeService;
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function execute(string $paymentSystem, array $data, ?string $promoCode = null): bool
    {
        $validator = $this->paymentValidatorFactory->getValidator($paymentSystem);

        $violations = $validator->validate($data);
        if (count($violations) > 0) {
            $this->handleValidationErrors($violations);
            return false;
        }

        $processor = $this->paymentProcessorFactory->getProcessor($paymentSystem);
        $processed = $processor->process($data);

        if ($processed) {
            $payment = $this->paymentFactory->create($data);
            if ($promoCode) {
                $this->promotionCodeService->applyPromotionCode($payment, $promoCode);
            }
            $this->paymentRepository->save($payment);
        }

        return $processed;
    }

    /**
     * @throws Exception
     */
    private function handleValidationErrors($violations): void
    {
        foreach ($violations as $violation) {
            throw new RuntimeException($violation->getMessage());
        }
    }
}