<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\TopSeasonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopSeasonRepository::class)]
class TopSeason
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $externalId;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    private ?float $score;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $scoredBy;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $animeRank;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $popularity;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $members;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $favorites;

    public function getAnimeRank(): ?int
    {
        return $this->animeRank;
    }

    public function setAnimeRank(?int $animeRank): TopSeason
    {
        $this->animeRank = $animeRank;

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): TopSeason
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getFavorites(): ?int
    {
        return $this->favorites;
    }

    public function setFavorites(?int $favorites): TopSeason
    {
        $this->favorites = $favorites;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): TopSeason
    {
        $this->id = $id;

        return $this;
    }

    public function getMembers(): ?int
    {
        return $this->members;
    }

    public function setMembers(?int $members): TopSeason
    {
        $this->members = $members;

        return $this;
    }

    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    public function setPopularity(?int $popularity): TopSeason
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(?float $score): TopSeason
    {
        $this->score = $score;

        return $this;
    }

    public function getScoredBy(): ?int
    {
        return $this->scoredBy;
    }

    public function setScoredBy(?int $scoredBy): TopSeason
    {
        $this->scoredBy = $scoredBy;

        return $this;
    }
}