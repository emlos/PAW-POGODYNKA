<?php

namespace App\Command;

use App\Repository\LocationRepository;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:location',
    description: 'znajduje lokacje po nazwie siti i kantry',
)]
class LocationCommand
{
    public function __construct(private readonly LocationRepository $locationRepository)
    {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument('kod kraju')] string $country,
        #[Argument('\"miasto\"')] string $city,
    ): int {
        $country = strtoupper(trim($country));
        $city = trim($city);
        $location = $this->locationRepository->findOneBy([
            'country' => $country,
            'city' => $city,
        ]);

        if ($location === null) {
            $io->error(sprintf('nie ma: %s, %s.', $city, $country));

            return Command::FAILURE;
        }

        $io->table(
            ['siti', 'kantri', 'longitud', 'letitud'],
            [[
                $location->getCity(),
                $location->getCountry(),
                $location->getLatitude(),
                $location->getLongitude(),
            ]],
        );

        return Command::SUCCESS;
    }
}
