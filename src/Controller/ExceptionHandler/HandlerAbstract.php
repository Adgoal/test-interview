<?php declare(strict_types=1);

namespace App\Controller\ExceptionHandler;

use App\Kernel\DIContainer;

abstract class HandlerAbstract implements HttpExceptionHandlerChainInterface
{
    protected HttpExceptionHandlerChainInterface $next;

    protected DIContainer $container;

    public function addNext(HttpExceptionHandlerChainInterface $next): void
    {
        $this->next = $next;
    }

    public function setContainer(DIContainer $container): void
    {
        $this->container = $container;
    }
}
