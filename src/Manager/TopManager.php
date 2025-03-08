<?php declare(strict_types=1);

namespace App\Manager;

use App\Builder\TopEntityBuilder;
use App\Entity\TopAnime;
use App\Exception\JikanApiClientException;
use App\Repository\TopAnimeRepository;
use App\Service\JikanApiClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

final readonly class TopManager
{

    public function __construct(
        private TopEntityBuilder $builder,
        private JikanApiClient $client,
        private EntityManagerInterface $em,
        private LoggerInterface $logger,
        private TopAnimeRepository $repository
    ) {
    }


    public function save(): void
    {
        $hasNextPage = true;
        $page = 1;

        while ($hasNextPage) {
            try {
                $content = $this->client->getTop($page);
                $data = $content['data'];
                $hasNextPage = $content['pagination']['has_next_page'];
                $this->buildTopData($data);
                $this->logger->info(sprintf("Saved top data for page: %s", $page));
                $page++;
                usleep(880000);
            } catch (JikanApiClientException $e) {
                $this->logger->error(sprintf("Failed to save top data: %s, page: %s", $e->getMessage(), $page));
            }
        }
    }

    private function buildTopData(array $data): void
    {
        foreach ($data as $item) {
            $top = $this->builder->build($item);
            $existing = $this->repository->findOneBy(['externalId' => $top->getExternalId()]);
            if ($existing instanceof TopAnime) {
                continue;
            }
            $this->em->persist($top);
        }
        $this->em->flush();
    }
}