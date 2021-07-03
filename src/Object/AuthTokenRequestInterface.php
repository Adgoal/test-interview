<?php declare(strict_types=1);

namespace App\Object;

interface AuthTokenRequestInterface
{
    /**
     * @return string
     */
    public function getToken(): string;
}
