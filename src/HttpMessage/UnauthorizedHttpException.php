<?php declare(strict_types=1);

namespace App\HttpMessage;

use Throwable;

final class UnauthorizedHttpException extends \RuntimeException
{
    public function __construct($message = "Unauthorized", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
