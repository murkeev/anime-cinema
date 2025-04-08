<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $externalId;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $title;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private string $titleEnglish;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private string $descriptionEnglish;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private int $yearOfPublication;

    #[ORM\ManyToOne(targetEntity: Anime::class, inversedBy: 'seasons')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Anime $anime = null;

    #[ORM\OneToOne(targetEntity: TopSeason::class)]
    private TopSeason $topSeason;

    public function __construct()
    {
    }

    public function getTitleEnglish(): string
    {
        return $this->titleEnglish;
    }

    public function setTitleEnglish(string $titleEnglish): Season
    {
        $this->titleEnglish = $titleEnglish;

        return $this;
    }

    public function getDescriptionEnglish(): string
    {
        return $this->descriptionEnglish;
    }

    public function setDescriptionEnglish(string $descriptionEnglish): Season
    {
        $this->descriptionEnglish = $descriptionEnglish;

        return $this;
    }

    public function getAnime(): ?Anime
    {
        return $this->anime;
    }

    public function setAnime(?Anime $anime): Season
    {
        $this->anime = $anime;

        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): Season
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Season
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Season
    {
        $this->title = $title;

        return $this;
    }

    public function getYearOfPublication(): int
    {
        return $this->yearOfPublication;
    }

    public function setYearOfPublication(int $yearOfPublication): Season
    {
        $this->yearOfPublication = $yearOfPublication;

        return $this;
    }

    public function getTopSeason(): TopSeason
    {
        return $this->topSeason;
    }

    public function setTopSeason(TopSeason $topSeason): Season
    {
        $this->topSeason = $topSeason;

        return $this;
    }
}