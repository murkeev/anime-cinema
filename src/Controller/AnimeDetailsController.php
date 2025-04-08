<?php declare(strict_types=1);

namespace App\Controller;

use App\Manager\SeasonManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/anime')]
class AnimeDetailsController extends AbstractController
{

    public function __construct(
        private SeasonManager $seasonManager,
    ) {
    }


    #[Route(path: '/', name: 'get-detail-info', methods: [Request::METHOD_GET])]
    public function __invoke(): JsonResponse
    {
        $this->seasonManager->getAllSeasonsDetails();
        dd();
    }
}