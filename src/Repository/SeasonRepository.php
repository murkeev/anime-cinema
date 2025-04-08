<?php

namespace App\Repository;

use App\Entity\Anime;
use App\Entity\Season;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Anime>
 */
class SeasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Season::class);
    }



    public function getAnimeBySeasonId(int $seasonId): ?Anime
    {
        return $this->createQueryBuilder('s')
            ->join(Anime::class, 'a')
            ->select('a')
            ->where('s.id = :id')
            ->setParameter('id', $seasonId)
            ->getQuery()
            ->getOneOrNullResult();
    }


}
