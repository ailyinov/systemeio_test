<?php

namespace App\Validator;

use App\Dto\TaxCountryCodeTrait;
use App\Repository\TaxRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxValidator extends ConstraintValidator
{
    use TaxCountryCodeTrait;

    private string $taxNumber;

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
        $this->setTaxNumber($value);

        /** @var \App\Entity\Tax $tax */
        $tax = $this->taxRepository->findOneBy(['country_code' => $this->taxCountryCode()]);
        if ($tax !== null) {
            if (preg_match("/^{$tax->getFormat()}$/", substr($value, 2,))) {
                return;
            }
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    private function setTaxNumber(string $taxNumber): void
    {
        $this->taxNumber = $taxNumber;
    }
}
