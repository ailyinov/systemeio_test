<?php

namespace App\Service;

use App\Dto\CalculatePriceDto;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRepository;

class PurchaseProcessor
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CouponRepository $couponRepository,
        private readonly TaxRepository $taxRepository,
    )
    {
    }

    public function process(CalculatePriceDto $calculatePriceDto): void
    {
        /** @var Product $product */
        $product = $this->productRepository->find($calculatePriceDto->getProduct());
        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->findOneBy(['code' => $calculatePriceDto->getCouponCode()]);
        /** @var Tax $tax */
        $tax = $this->taxRepository->findOneBy(['country_code' => $calculatePriceDto->taxCountryCode()]);
        if ($tax !== null) {
            
        }
    }
}