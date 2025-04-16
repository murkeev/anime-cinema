<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\Season;
use App\Entity\TopSeason;

class SeasonEntityBuilder
{
    public function build(mixed $data, string $externalId): Season
    {
//        $relations = $data['data']['relations'] ?? null;
//        $result = [];
//        if ($relations !== null) {
//            foreach ($relations as $relation) {
//                if(in_array(['Prequel', 'Sequel'], $relation['relation'], true)) {
//                    foreach ($relation['entry'] as $entry) {
//                        $result = [
//                            'external_id' => $entry['mal_id'],
//                            'title' => $entry['name'],
//                            'relation' => $relation['relation'],
//                        ];
//                    }
//                }
//            }
//        }


        return (new Season())
            ->setExternalId($externalId)
            ->setTitle($data['data']['title'])
            ->setTitleEnglish($data['data']['title_english'])
            ->setDescriptionEnglish($data['data']['synopsis'])
            ->setYearOfPublication($data['data']['year']);
    }
}