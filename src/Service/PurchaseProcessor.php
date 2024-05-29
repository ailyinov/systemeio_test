<?php

namespace App\Service;

use App\Dto\CalculatePriceDto;
use App\Dto\PurchaseDto;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class PurchaseProcessor
{
    public function __construct(
        private readonly PriceCalculator $priceCalculator,
        private readonly PaypalPaymentProcessor $paypalPaymentProcessor,
        private readonly StripePaymentProcessor $stripePaymentProcessor,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function process(PurchaseDto $purchaseDto): void
    {
        $price = $this->priceCalculator->calculate(new CalculatePriceDto(
            $purchaseDto->getProduct(),
            $purchaseDto->getTaxNumber(),
            $purchaseDto->getCouponCode()
        ));

        switch ($purchaseDto->getPaymentProcessor()) {
            case 'paypal':
                $this->paypalPaymentProcessor->pay((int) $price);
                break;
            case 'stripe':
                $this->stripePaymentProcessor->processPayment($price);
                break;
        }
    }
}