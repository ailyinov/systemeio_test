<?php

namespace App\Controller;

use App\Dto\CalculatePriceDto;
use App\Entity\Coupon;
use App\Service\PurchaseProcessor;
use App\Service\PriceCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class PriceController extends AbstractController
{
    #[Route('/calculate-price', name: 'app_price_calc', methods: ['POST'])]
    public function calculate(#[MapRequestPayload] CalculatePriceDto $calculatePriceDto, PriceCalculator $priceCalculator): JsonResponse
    {
        $priceCalculator->calculate($calculatePriceDto);
        return $this->json([
            'success' => 'ok'
        ]);
    }

//    #[Route('/purchase', name: 'app_price_purchase', methods: ['POST'])]
//    public function purchase(#[MapRequestPayload] CalculatePriceDto $calculatePriceDto, PurchaseProcessor $purchaseProcessor): JsonResponse
//    {
//        return $this->json([
//            'success' => 'ok'
//        ]);
//    }
}
