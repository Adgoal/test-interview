<?php declare(strict_types=1);

namespace App\Service\Auth;

interface AuthServiceInterface
{
    public function generateToken(): string;

    /**
     * @param string $token
     * @throws InvalidTokenException
     * @return bool
     */
    public function isExpired(string $token): bool;

    public function checkCredentials(string $login, string $password): bool;
}
