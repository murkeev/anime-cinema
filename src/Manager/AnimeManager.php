<?php

namespace App\Manager;

use App\Repository\AnimeRepository;
use App\Repository\SeasonRepository;
use App\Service\JikanApiClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

final readonly class AnimeManager
{

    public function __construct(
        private JikanApiClient $client,
        private EntityManagerInterface $em,
        private LoggerInterface $logger,
        private AnimeRepository $animeRepo,
        private SeasonRepository $seasonRepo,
        private AnimeEntityBuilder $animeBuilder
    ) {
    }
}