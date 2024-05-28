<?php

namespace App\Controller;

use App\Validator\CalculatePrice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class PriceController extends AbstractController
{
    #[Route('/calculate-price', name: 'app_price_calc', methods: ['POST'])]
    public function calculate(#[MapRequestPayload] CalculatePrice $calculatePrice,): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PriceController.php',
        ]);
    }

    #[Route('/purchase', name: 'app_price_purchase', methods: ['POST'])]
    public function purchase(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PriceController.php',
        ]);
    }

    public static function getSubscribedServices(): array
    {
        return [

        ];
    }
}
