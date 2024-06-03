<?php

declare(strict_types=1);

namespace App\Controller;

use App\Factory\ReviewsFactory;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

class ActionController extends AbstractController
{
    public function __construct(
        private readonly ReviewRepository $reviewRepository
    ) {
    }

    #[Route(path: '/api/action/first', name: 'first_action', methods: ['GET'])]
    public function doFirstAction(): JsonResponse
    {
        return new JsonResponse('ok');
    }
}
