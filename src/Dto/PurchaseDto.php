<?php

namespace App\Dto;

use App\Validator\CouponExists;
use App\Validator\ProductExists;
use App\Validator\Tax;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseDto
{
    use TaxCountryCodeTrait;

    public function __construct(
        #[Assert\NotBlank]
        #[ProductExists]
        private readonly int    $product,

        #[Assert\NotBlank]
        #[Tax]
        private readonly string $taxNumber,

        #[CouponExists]
        private readonly ?string $couponCode,

        #[Assert\Choice(['paypal', 'stripe'])]
        private readonly string $paymentProcessor,
    )
    {
    }

    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }

    public function getProduct(): int
    {
        return $this->product;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }
}
