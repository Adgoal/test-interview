<?php declare(strict_types=1);

namespace App\Controller;

use App\Kernel\DIContainer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ControllerInterface
{
    public function handleRequest(RequestInterface $request): ResponseInterface;

    /**
     * @param DIContainer $container
     */
    public function setContainer(DIContainer $container): void;
}
