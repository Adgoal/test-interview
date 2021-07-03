<?php declare(strict_types=1);

namespace App\Controller\ExceptionHandler;

use App\HttpMessage\AccessDeniedException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class AccessDeniedHandler extends HandlerAbstract
{
    public function handle(RequestInterface $request, \Throwable $throwable): ResponseInterface
    {
        if (!$throwable instanceof AccessDeniedException){
            return $this->next->handle($request, $throwable);
        }

        return $this->container->getJsonResponseFactory()->makeJsonResponse(403);
    }
}
