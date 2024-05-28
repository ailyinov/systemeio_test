<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraints as Assert;

class CalculatePrice
{
    public function __construct(
        #[Assert\GreaterThanOrEqual(1)]
        #[Assert\LessThanOrEqual(5)]
        public readonly int $product,

        #[Assert\NotBlank]
        #[Assert\Length(min: 10, max: 500)]
        public readonly string $taxNumber,

        #[Assert\NotBlank]
        #[Assert\Length(min: 10, max: 500)]
        public readonly string $couponCode,
    ) {
    }
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'The value "{{ value }}" is not valid.';
}
