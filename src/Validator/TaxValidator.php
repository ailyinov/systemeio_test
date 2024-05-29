<?php

namespace App\Validator;

use App\Repository\ProductRepository;
use App\Repository\TaxRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxValidator extends ConstraintValidator
{
    public function __construct(
        private readonly TaxRepository $taxRepository
    )
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $countryCode = substr($value, 0, 2);

        /** @var \App\Entity\Tax $tax */
        $tax = $this->taxRepository->findOneBy(['country_code' => $countryCode]);
        if ($tax !== null) {
            if (preg_match("/{$tax->getFormat()}/", substr($value, 2,))) {
                return;
            }
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
