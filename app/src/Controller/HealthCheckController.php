<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController 
{
    #[Route('/api/health', name: 'health_check', methods: ['post'])]
    public function __invoke(): Response
    {
        return new JsonResponse(['ok']);
    }
}
