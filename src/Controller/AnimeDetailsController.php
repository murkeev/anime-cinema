<?php

namespace App\Controller;

use App\Entity\Anime;
use App\Service\JikanApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/anime')]
class AnimeDetailsController extends AbstractController
{

    public function __construct(
        private JikanApiClient $jikanApiClient
    ) {
    }

    #[Route(path: '/{id}', name: 'get-detail-info', methods: [Request::METHOD_GET])]
    public function __invoke(int $id): JsonResponse
    {
        $data = $this->jikanApiClient->getSeasonDetails($id);
        return new JsonResponse($data, Response::HTTP_OK);

    }
}