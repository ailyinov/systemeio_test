<?php

namespace App\Service;

use App\Dto\CalculatePriceDto;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRepository;

class PriceCalculator
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CouponRepository $couponRepository,
        private readonly TaxRepository $taxRepository,
    )
    {
    }

    public function calculate(CalculatePriceDto $calculatePriceDto): float
    {
        /** @var Product $product */
        $product = $this->productRepository->find($calculatePriceDto->getProduct());
        /** @var Coupon $coupon */
        $coupon = null;
        if ($calculatePriceDto->getCouponCode() !== null) {
            $coupon = $this->couponRepository->findOneBy(['code' => $calculatePriceDto->getCouponCode()]);
        }
        /** @var Tax $tax */
        $tax = $this->taxRepository->findOneBy(['country_code' => $calculatePriceDto->taxCountryCode()]);

        $price = $product->getPrice();
        if ($coupon !== null) {
            $discount = $coupon->getIsPercent() ? $coupon->getDiscount() / $price * 100 : $coupon->getDiscount();
            $price -= $discount;
        }
        $price += $price * ($tax->getPercent() / 100);

        return $price;
    }
}