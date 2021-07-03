<?php declare(strict_types=1);

namespace App\Repository;

final class DefaultRepository
{
    private \PDO $PDO;
    private string $dsn;
    private string $username;
    private string $password;

    public function __construct(string $dsn, string $username, string $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
    }

    private function pdo(): \PDO
    {
        return $this->PDO ?? $this->PDO = new \PDO($this->dsn, $this->username, $this->password);
    }

    public function fetchAll(string $sql, array $parameters = null): array
    {
        $prepared = $this->pdo()->prepare($sql);
        $prepared->execute($parameters);

        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
    }
}
