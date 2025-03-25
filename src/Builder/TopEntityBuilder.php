<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\TopSeason;

final readonly class TopEntityBuilder
{
    public function build(?array $item = null): TopSeason
    {
        if ($item === null) {
            return new TopSeason();
        }

        return (new TopSeason())
            ->setExternalId((string)($item['mal_id'] ?? null))
            ->setScore($item['score'] ?? null)
            ->setScoredBy($item['scored_by'] ?? null)
            ->setAnimeRank($item['rank'] ?? null)
            ->setPopularity($item['popularity'] ?? null)
            ->setMembers($item['members'] ?? null)
            ->setFavorites($item['favorites'] ?? null);
    }
}