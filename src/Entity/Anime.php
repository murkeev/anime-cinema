<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\AnimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimeRepository::class)]
class Anime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::BOOLEAN, nullable: false)]
    private ?bool $ongoing;

    #[ORM\OneToMany(mappedBy: 'anime', targetEntity: Season::class, cascade: ['persist'])]
    private Collection $seasons;

    public function __construct()
    {
        $this->seasons = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Anime
    {
        $this->id = $id;

        return $this;
    }

    public function getOngoing(): ?bool
    {
        return $this->ongoing;
    }

    public function setOngoing(?bool $ongoing): Anime
    {
        $this->ongoing = $ongoing;

        return $this;
    }

//    TODO: to service layer
//    public function getYearsOfPublication(): array
//    {
//        $years = [];
//        foreach ($this->seasons as $season) {
//            if ($season->getYearOfPublication() !== null) {
//                $years[] = $season->getYearOfPublication();
//            }
//        }
//        return array_unique($years);
//    }



    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function setSeasons(Collection $seasons): Anime
    {
        $this->seasons = $seasons;

        return $this;
    }

    public function addSeason(Season $season): Anime
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons->add($season);
            $season->setAnime($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): Anime
    {
        if ($this->seasons->contains($season)) {
            $this->seasons->removeElement($season);
        }

        return $this;
    }
}