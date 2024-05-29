<?php

namespace App\Tests;

use App\Dto\CalculatePriceDto;
use App\Dto\PurchaseDto;
use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRepository;
use App\Service\PriceCalculator;
use PHPUnit\Framework\TestCase;

class CalculateTest extends TestCase
{
    public function testSomething(): void
    {
        $p = new Product();
        $p->setName('test')
            ->setPrice(100);

        $pr = $this->createMock(ProductRepository::class);
        $pr->expects($this->any())
            ->method('find')
            ->willReturn($p);

        $c = new Coupon();
        $c->setIsPercent(true)
            ->setDiscount(6);
        $cr = $this->createMock(CouponRepository::class);
        $cr->expects($this->any())
            ->method('findOneBy')
            ->willReturn($c);

        $t = new Tax();
        $t->setPercent(24);
        $tr = $this->createMock(TaxRepository::class);
        $tr->expects($this->any())
            ->method('findOneBy')
            ->willReturn($t);

        $pc = new PriceCalculator(
            $pr,
            $cr,
            $tr
        );

        $res = $pc->calculate(new CalculatePriceDto(1, 'asf', 'asdf'));

        $this->assertEquals(116.56, $res); // example test from readme
    }
}
