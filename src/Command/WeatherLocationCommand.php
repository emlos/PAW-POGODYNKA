<?php

namespace App\Command;

use App\Entity\Measurement;
use App\Repository\LocationRepository;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:location',
    description: 'pokazuje pogode',
)]
class WeatherLocationCommand
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly WeatherUtil $weatherUtil,
    ) {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Location ID')] int $id,
    ): int {
        $location = $this->locationRepository->find($id);

        if ($location === null) {
            $io->error(sprintf('nie ma \"%d\"', $id));

            return Command::FAILURE;
        }

        $measurements = $this->weatherUtil->getWeatherForLocation($location);

        $io->writeln(sprintf('Locja: %s', $location->getCity()));
        $io->table(['Data', 'temperatura w ce'], array_map(
            fn (Measurement $measurement): array => [
                $measurement->getDate()->format('Y-m-d'),
                $measurement->getCelsius(),
            ],
            $measurements,
        ));

        return Command::SUCCESS;
    }
}
