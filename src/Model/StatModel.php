<?php declare(strict_types=1);

namespace App\Model;

use App\Repository\StatRepository;

final class StatModel implements StatModelInterface
{
    private const MIN_RATE = 10;

    private StatRepository $statRepository;

    public function __construct(StatRepository $statRepository)
    {
        $this->statRepository = $statRepository;
    }

    public function getActiveNetworks(): array
    {
        return $this->statRepository->findActiveNetworkIds(self::MIN_RATE);
    }
}
