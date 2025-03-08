<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\TopAnime;

final readonly class TopEntityBuilder
{
    public function build(array $item): TopAnime
    {
        return (new TopAnime())
            ->setExternalId((string)$item['mal_id'])
            ->setScore($item['score'])
            ->setScoredBy($item['scored_by'])
            ->setAnimeRank($item['rank'])
            ->setPopularity($item['popularity'])
            ->setMembers($item['members'])
            ->setFavorites($item['favorites']);
    }
}