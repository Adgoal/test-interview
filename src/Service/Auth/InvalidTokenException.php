<?php declare(strict_types=1);

namespace App\Service\Auth;

class InvalidTokenException extends \RuntimeException
{
    public function __construct($message = "Invalid token")
    {
        parent::__construct($message);
    }
}
