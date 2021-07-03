<?php declare(strict_types=1);

namespace App\Kernel;

use App\Controller\ControllerInterface;
use App\Controller\ExceptionHandler\HttpExceptionHandlerChainInterface;

interface HttpKernelInterface
{
    public function addRoute(string $method, string $path, ControllerInterface $controller): void;

    public function addHttpExceptionHandler(HttpExceptionHandlerChainInterface $httpExceptionHandler): void;
}
