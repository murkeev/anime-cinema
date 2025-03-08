<?php declare(strict_types=1);

namespace App\Controller;

use App\Message\GetTopAnimeMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/top')]
final class TopController extends AbstractController
{

    public function __construct(
        private readonly MessageBusInterface $messageBus
    ) {

    }

    #[Route(path: '/', name: 'get-top', methods: [Request::METHOD_GET])]
    public function __invoke(): JsonResponse
    {
        $this->messageBus->dispatch(new GetTopAnimeMessage());
        return new JsonResponse('OK', Response::HTTP_OK);
    }
}