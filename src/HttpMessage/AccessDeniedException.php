<?php declare(strict_types=1);

namespace App\HttpMessage;

use Throwable;

final class AccessDeniedException extends \RuntimeException
{
    public function __construct($message = "Access denied", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
