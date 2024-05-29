<?php

namespace App\Validator;

use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CouponExistsValidator extends ConstraintValidator
{
    public function __construct(
        private readonly CouponRepository $couponRepository
    )
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $product = $this->couponRepository->findOneBy(['code' => $value]);
        if ($product !== null) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
