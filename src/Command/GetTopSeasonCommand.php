<?php declare(strict_types=1);

namespace App\Command;

use App\Manager\TopManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:get-top-anime',
    description: 'Get top anime'
)]
final class GetTopSeasonCommand extends Command
{
    public function __construct(private readonly TopManager $topManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Get top anime. Command stops working after 331 pages of data due to Jikan API rate limit.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->topManager->save($io);
        return Command::SUCCESS;
    }
}