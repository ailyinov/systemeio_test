<?php

namespace App\Dto;

use App\Validator\CouponExists;
use App\Validator\ProductExists;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceDto
{
    public function __construct(
        #[Assert\GreaterThanOrEqual(1)]
        #[ProductExists]
        public readonly int $product,

        #[Assert\NotBlank]
        public readonly string $taxNumber,

        #[Assert\NotBlank]
        #[CouponExists]
        public readonly string $couponCode,
    ) {
    }
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'The value "{{ value }}" is not valid.';
}
