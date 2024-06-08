<?php

declare(strict_types=1);

namespace App\Property\Command;

use App\Property\Factory\HotelFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:create-properties')]
class CreateHotelsCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ){
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $bar = new ProgressBar($output);
        $total = 1000000;
        $batchSize = 100;
        $iteration = 0;

        while (true) {
            $bar->advance();
            $hotel = HotelFactory::create();
            $this->em->persist($hotel);
            $iteration++;

            if ($iteration % $batchSize === 0) {
                $this->em->flush();
                $this->em->clear();
            }

            if ($iteration === $total) {
                break;
            }
        }
        $bar->finish();

        $this->em->flush();
        $this->em->clear();

        return Command::SUCCESS;
    }
}
