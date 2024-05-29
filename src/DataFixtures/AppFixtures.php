<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $p1 = new Product();
         $p1->setName('iphone')
             ->setPrice(100.00)
         ;
         $manager->persist($p1);

        $p2 = new Product();
        $p2->setName('headphones')
            ->setPrice(20.00)
        ;
        $manager->persist($p2);

        $p3 = new Product();
        $p3->setName('case')
            ->setPrice(10.00)
        ;
        $manager->persist($p3);

        $c1 = new Coupon();
        $c1->setCode('F10')
            ->setDiscount(10)
            ->setIsPercent(false)
        ;
        $manager->persist($c1);

        $c2 = new Coupon();
        $c2->setCode('F5')
            ->setDiscount(5)
            ->setIsPercent(false)
        ;
        $manager->persist($c2);

        $c3 = new Coupon();
        $c3->setCode('P20')
            ->setDiscount(20)
            ->setIsPercent(true)
        ;
        $manager->persist($c3);

        $c4 = new Coupon();
        $c4->setCode('P30')
            ->setDiscount(30)
            ->setIsPercent(true)
        ;
        $manager->persist($c4);

        /**
         * Германия - 19%
         * Италия - 22%
         * Франция - 20%
         * Греция - 24%
         *
         * DEXXXXXXXXX - Германия
         * ITXXXXXXXXXXX - Италия
         * GRXXXXXXXXX - Греция
         * FRYYXXXXXXXXX - Франция
         * где X - любая цифра от 0 до 9, Y - любая буква. Длина налогового номера различается в зависимости от страны.
         */
        $t1 = new Tax();
        $t1->setCountryCode('DE')
            ->setPercent(19)
            ->setFormat('\d{9}')
        ;
        $manager->persist($t1);

        $t2 = new Tax();
        $t2->setCountryCode('IT')
            ->setPercent(22)
            ->setFormat('\d{11}')
        ;
        $manager->persist($t2);

        $t3 = new Tax();
        $t3->setCountryCode('FR')
            ->setPercent(20)
            ->setFormat('[a-zA-Z]{2}\d{9}')
        ;
        $manager->persist($t3);

        $t4 = new Tax();
        $t4->setCountryCode('GR')
            ->setPercent(24)
            ->setFormat('\d{9}')
        ;
        $manager->persist($t4);

        $manager->flush();
    }
}
