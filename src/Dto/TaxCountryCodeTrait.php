<?php

namespace App\Dto;

trait TaxCountryCodeTrait
{
    abstract public function getTaxNumber(): string;
    public function taxCountryCode(): string
    {
        return substr($this->getTaxNumber(), 0, 2);
    }
}