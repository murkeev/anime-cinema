<?php declare(strict_types=1);

namespace App\Manager;

use App\Builder\SeasonEntityBuilder;
use App\Entity\Season;
use App\Entity\TopSeason;
use App\Exception\JikanApiClientException;
use App\Repository\SeasonRepository;
use App\Repository\TopSeasonRepository;
use App\Service\JikanApiClient;
use Doctrine\ORM\EntityManagerInterface;

final readonly class SeasonManager
{

    public function __construct(
        private EntityManagerInterface $em,
        private JikanApiClient $jikanApiClient,
        private TopSeasonRepository $topSeasonRepository,
        private SeasonRepository $seasonRepository,
        private SeasonEntityBuilder $builder,
    ) {
    }

    /**
     * @throws JikanApiClientException
     */
    public function getAllSeasonsDetails(): void
    {
        foreach ($this->getExternalIds() as $id) {
            $data = $this->jikanApiClient->getSeasonData($id);
            $season = $this->builder->build($data, $id);
            $this->setTopSeason($season, $id);
            if (!$this->isSeasonExists($id)) {
                $this->save($season);
            }
            usleep(880000);
        }
    }

    private function setTopSeason(Season $season, string $externalId): Season
    {
        /** @var TopSeason $topSeason */
        $topSeason = $this->topSeasonRepository->findOneBy(['externalId' => $externalId]);
        $season->setTopSeason($topSeason);

        return $season;
    }

    private function save(Season $season): void
    {
        $this->em->persist($season);
        $this->em->flush();
        $this->em->clear();
    }

    /** @return array<int,string> */
    private function getExternalIds(): array
    {
        return $this->topSeasonRepository->findAllExternalIds();
    }

    private function isSeasonExists(string $externalId): bool
    {
        $season = $this->seasonRepository->findOneBy(['externalId' => $externalId]);

        return null !== $season;
    }
}