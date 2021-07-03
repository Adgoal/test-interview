<?php declare(strict_types=1);

namespace App;

use App\Controller\ExceptionHandler\AccessDeniedHandler;
use App\Controller\ExceptionHandler\BadRequestHandler;
use App\Controller\ExceptionHandler\UnauthorizedHandler;
use App\Controller\LoginController;
use App\Controller\StatController;
use App\Kernel\DIContainer;
use App\Kernel\HttpKernelInterface;

return function (HttpKernelInterface $kernel, DIContainer $container): void
{
    $kernel->addRoute('POST', '/login', new LoginController());
    $kernel->addRoute('GET', '/stat', new StatController());

    $kernel->addHttpExceptionHandler(new BadRequestHandler());
    $kernel->addHttpExceptionHandler(new AccessDeniedHandler());
    $kernel->addHttpExceptionHandler(new UnauthorizedHandler());
};
