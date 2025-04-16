<?php declare(strict_types=1);

namespace App\Manager;

use App\Repository\SeasonRepository;
use App\Service\JikanApiClient;
use Doctrine\ORM\EntityManagerInterface;

final readonly class AnimeManager
{
    public function __construct(
        private EntityManagerInterface $em,
        private JikanApiClient $jikanApiClient,
        private SeasonRepository $seasonRepository,
    ) {

    }

    private function getAllSeasons(): array
    {
        return $this->seasonRepository->findAll();
    }

}