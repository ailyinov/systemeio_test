<?php

namespace App\Dto;

use App\Validator\CouponExists;
use App\Validator\ProductExists;
use App\Validator\Tax;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceDto
{
    use TaxCountryCodeTrait;

    public function __construct(
        #[Assert\GreaterThanOrEqual(1)]
        #[Assert\NotBlank]
        #[ProductExists]
        private readonly int    $product,

        #[Assert\NotBlank]
        #[Tax]
        private readonly string $taxNumber,

        #[Assert\NotBlank]
        #[CouponExists]
        private readonly string $couponCode,
    )
    {
    }

    public function getProduct(): int
    {
        return $this->product;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function getCouponCode(): string
    {
        return $this->couponCode;
    }
}
