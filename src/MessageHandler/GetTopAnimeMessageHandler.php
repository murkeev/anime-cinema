<?php

namespace App\MessageHandler;

use App\Manager\TopManager;
use App\Message\GetTopAnimeMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetTopAnimeMessageHandler
{

    public function __construct(private TopManager $topManager)
    {
    }

    public function __invoke(GetTopAnimeMessage $message): void
    {
        $this->topManager->save();
    }
}