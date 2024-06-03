<?php

declare(strict_types=1);

namespace App\Command;

use App\Factory\ReviewsFactory;
use App\Repository\ReviewRepository;
use Doctrine\DBAL\Driver\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\APC;
use Prometheus\Storage\InMemory;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
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
        $bar = new ProgressBar($output);
        $batchSize = 100;
        $this->entityManager->getConfiguration()->setMiddlewares([new \Doctrine\DBAL\Logging\Middleware(new NullLogger())]);
        $counter = 0;

        while ($counter < 1500) {
            $counter++;
            $review = ReviewsFactory::create(Uuid::v7()->toString());
            $this->entityManager->persist($review);
            $this->entityManager->flush();
            $this->entityManager->clear();
            $bar->advance();
        }

        $bar->finish();

        return Command::SUCCESS;
    }
}
