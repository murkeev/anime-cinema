<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\Season;
use App\Entity\TopSeason;

class SeasonEntityBuilder
{
    public function build(mixed $data, string $externalId): Season
    {
        return (new Season())
            ->setExternalId($externalId)
            ->setTitle($data['data']['title'])
            ->setTitleEnglish($data['data']['title_english'])
            ->setDescriptionEnglish($data['data']['synopsis'])
            ->setYearOfPublication($data['data']['year']);
    }
}