<?php

declare(strict_types=1);

namespace App\Command;

use App\Factory\ReviewsFactory;
use App\Repository\ReviewRepository;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;

#[AsCommand(name: 'app:reviews-create')]
class CreateReviewsCommand extends Command
{
    public function __construct(
        private readonly ReviewRepository $reviewRepository,
        private readonly EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        ini_set('memory_limit', '1G');

        $bar = new ProgressBar($output);

        $batchSize = 100;
        $this->entityManager->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);
        $counter = 0;

        while ($counter < 500000) {
            $counter++;
            $review = ReviewsFactory::create(Uuid::v7()->toString());
            $this->entityManager->persist($review);

            if ($counter % $batchSize === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }

            $bar->advance();
        }

        $this->entityManager->flush();
        $this->entityManager->clear();

        $output->writeln('');
        $output->writeln('Usage: '. Helper::formatMemory(memory_get_usage()));
        $output->writeln('Real: ' . Helper::formatMemory(memory_get_usage(true)));
        $output->writeln('Peak: ' . Helper::formatMemory(memory_get_peak_usage(true)));
        $output->writeln('');

        $bar->finish();

        return Command::SUCCESS;
    }
}
