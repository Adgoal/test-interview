<?php declare(strict_types=1);

namespace App\Repository;

final class StatRepository
{
    private DefaultRepository $defaultRepository;

    public function __construct(DefaultRepository $defaultRepository)
    {
        $this->defaultRepository = $defaultRepository;
    }

    public function findActiveNetworkIds(int $minRate = 0): array
    {
        return $this->defaultRepository->fetchAll(
            'SELECT p.network_id FROM programs as p WHERE p.active = 1 GROUP by p.network_id HAVING MIN(p.rate) > :rate',
            ['rate' => $minRate]
        );
    }
}
