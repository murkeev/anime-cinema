<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\TopSeason;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TopSeasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TopSeason::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('e')->getQuery()->getResult();
    }

    public function findAllExternalIds(): array
    {
        return array_column(
            $this->createQueryBuilder('s')
                ->select('s.externalId')
                ->getQuery()
                ->getResult()
        , 'externalId');
    }
}