<?php declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(
    name: 'app:get-season',
    description: 'Get season'
)]
final class GetSeasonCommand extends Command
{
    // TODO: run with cron and GetTopSeasonCommand.php
    // TODO: use symfony scheduler
}