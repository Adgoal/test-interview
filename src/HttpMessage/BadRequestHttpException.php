<?php declare(strict_types=1);

namespace App\HttpMessage;

use Throwable;

final class BadRequestHttpException extends \RuntimeException
{
    public function __construct($message = "Submitted data is not valid", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
