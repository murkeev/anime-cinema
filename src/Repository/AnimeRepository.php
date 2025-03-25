<?php

namespace App\Repository;

use App\Entity\Anime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Anime>
 */
class AnimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anime::class);
    }

    public function getSortedAnime()
    {
        return $this->createQueryBuilder('a')
            ->join('a.seasons', 's')
            ->groupBy('a.id')
            ->orderBy('MAX(a.popularity)', 'DESC')
            ->getQuery()
            ->getResult();
    }



}
