<?php declare(strict_types=1);

namespace App\Controller\ExceptionHandler;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class HandlerDefault extends HandlerAbstract
{
    public function handle(RequestInterface $request, \Throwable $throwable): ResponseInterface
    {
        return $this->container->getJsonResponseFactory()->makeJsonResponse(500, [], json_encode([
            'message' => $throwable->getMessage(),
            'trace' => $throwable->getTraceAsString()
        ]));
    }
}
