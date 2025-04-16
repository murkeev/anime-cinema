<?php declare(strict_types=1);

namespace App\Command;

use App\Manager\SeasonManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:season:list',
    description: 'Get and save list of seasons',
)]
final class GetSeasonCommand extends Command
{
    public function __construct(private readonly SeasonManager $seasonManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Get list of seasons');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->seasonManager->getAllSeasonsDetails();
        return Command::SUCCESS;
    }
}