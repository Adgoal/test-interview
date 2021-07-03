<?php declare(strict_types=1);

namespace App\Controller;

use App\Object\AuthTokenRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class StatController extends ControllerAbstract
{
    public function handleRequest(RequestInterface $request): ResponseInterface
    {
        $this->throwExceptionIfInvalidToken(new AuthTokenRequest($request));

        return $this->jsonResponse(
            $this->container->getStatModel()->getActiveNetworks()
        );
    }
}
