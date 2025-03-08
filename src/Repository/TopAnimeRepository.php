<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\TopAnime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TopAnimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TopAnime::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('e')->getQuery()->getResult();
    }
}