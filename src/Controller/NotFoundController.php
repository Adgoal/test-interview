<?php declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class NotFoundController extends ControllerAbstract
{
    public function handleRequest(RequestInterface $request): ResponseInterface
    {
        return $this->container->getJsonResponseFactory()->makeJsonResponse(404, [], json_encode([
            'message' => 'Not found'
        ]));
    }
}
