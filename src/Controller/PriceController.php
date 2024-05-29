<?php

namespace App\Controller;

use App\Dto\CalculatePriceDto;
use App\Dto\PurchaseDto;
use App\Service\PurchaseProcessor;
use App\Service\PriceCalculator;
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

    #[Route('/purchase', name: 'app_price_purchase', methods: ['POST'])]
    public function purchase(#[MapRequestPayload] PurchaseDto $purchaseDto, PurchaseProcessor $purchaseProcessor): JsonResponse
    {
        $purchaseProcessor->process($purchaseDto);
        return $this->json([
            'success' => 'ok'
        ]);
    }
}
