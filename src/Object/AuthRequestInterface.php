<?php declare(strict_types=1);

namespace App\Object;

interface AuthRequestInterface
{
    /**
     * @return string
     */
    public function getLogin(): string;

    /**
     * @return string
     */
    public function getPassword(): string;
}
