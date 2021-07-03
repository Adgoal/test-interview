<?php declare(strict_types=1);

namespace App\Controller;

use App\Kernel\DIContainer;
use App\Object\AuthTokenRequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class ControllerAbstract implements ControllerInterface
{
    protected DIContainer $container;

    /**
     * @param array|\JsonSerializable $data
     * @return ResponseInterface
     */
    public function jsonResponse($data): ResponseInterface
    {
        return $this->container->getJsonResponseFactory()->makeJsonResponse(200, [], json_encode($data));
    }

    public function throwExceptionIfInvalidToken(AuthTokenRequestInterface $tokenRequest): void
    {
        $this->container->getAuthModel()->throwExceptionIfInvalidToken($tokenRequest);
    }

    public function setContainer(DIContainer $container): void
    {
        $this->container = $container;
    }
}
