<?php

namespace App\Validator;

use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ProductExistsValidator extends ConstraintValidator
{
    public function __construct(
        private readonly ProductRepository $productRepository
    )
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $product = $this->productRepository->find($value);
        if ($product !== null) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
