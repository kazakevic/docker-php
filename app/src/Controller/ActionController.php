<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ActionController extends AbstractController
{
    #[Route(path: '/api/action/first', name: 'first_action', methods: ['GET'])]
    public function doFirstAction(): JsonResponse
    {
        return new JsonResponse('ok');
    }
}
