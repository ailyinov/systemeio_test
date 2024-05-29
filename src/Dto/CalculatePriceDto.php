<?php

namespace App\Dto;

use App\Validator\CouponExists;
use App\Validator\ProductExists;
use App\Validator\Tax;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceDto
{
    public function __construct(
        #[Assert\GreaterThanOrEqual(1)]
        #[Assert\NotBlank]
        #[ProductExists]
        public readonly int $product,

        #[Assert\NotBlank]
        #[Tax]
        public readonly string $taxNumber,

        #[Assert\NotBlank]
        #[CouponExists]
        public readonly string $couponCode,
    ) {
    }
}
