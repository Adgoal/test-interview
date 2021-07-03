<?php declare(strict_types=1);

namespace App\Controller\ExceptionHandler;

use App\HttpMessage\BadRequestHttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class BadRequestHandler extends HandlerAbstract
{
    public function handle(RequestInterface $request, \Throwable $throwable): ResponseInterface
    {
        if (!$throwable instanceof BadRequestHttpException){
            return $this->next->handle($request, $throwable);
        }

        return $this->container->getJsonResponseFactory()->makeJsonResponse(400, [], json_encode([
            'message' => $throwable->getMessage()
        ]));
    }
}
