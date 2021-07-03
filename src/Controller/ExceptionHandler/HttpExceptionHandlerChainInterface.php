<?php declare(strict_types=1);

namespace App\Controller\ExceptionHandler;

use App\Kernel\DIContainer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpExceptionHandlerChainInterface
{
    /**
     * @param RequestInterface $request
     * @param \Throwable $throwable
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request, \Throwable $throwable): ResponseInterface;

    /**
     * @param DIContainer $container
     */
    public function setContainer(DIContainer $container): void;

    /**
     * @param HttpExceptionHandlerChainInterface $next
     */
    public function addNext(HttpExceptionHandlerChainInterface $next): void;
}
