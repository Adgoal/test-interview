<?php declare(strict_types=1);

namespace App\Kernel;

use App\Controller\ControllerInterface;
use App\Controller\ExceptionHandler\HandlerDefault;
use App\Controller\ExceptionHandler\HttpExceptionHandlerChainInterface;
use App\Controller\NotFoundController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class HttpKernel implements HttpKernelInterface
{
    private DIContainer $container;

    /**
     * @var ControllerInterface[][]
     */
    private array $routes;

    private HttpExceptionHandlerChainInterface $httpExceptionHandler;

    public function __construct(DIContainer $container)
    {
        $this->container = $container;
        $this->routes = [];

        $this->httpExceptionHandler = $this->createDefaultHttpExceptionHandler($container);
    }

    public function addRoute(string $method, string $path, ControllerInterface $controller): void
    {
        $controller->setContainer($this->container);

        $this->routes[strtoupper($method)][$path] = $controller;
    }

    /**
     * @param HttpExceptionHandlerChainInterface $httpExceptionHandler
     */
    public function addHttpExceptionHandler(HttpExceptionHandlerChainInterface $httpExceptionHandler): void
    {
        $httpExceptionHandler->addNext(
            $this->httpExceptionHandler
        );
        $httpExceptionHandler->setContainer($this->container);

        $this->httpExceptionHandler = $httpExceptionHandler;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function handleRequest(RequestInterface $request): ResponseInterface
    {
        try {
            $response = $this
                ->getController($request->getMethod(), $request->getUri()->getPath())
                ->handleRequest($request);
        } catch (\Throwable $exception){
            $response = $this->httpExceptionHandler->handle(
                $request,
                $exception
            );
        }

        return $response;
    }

    private function getController(string $method, string $path): ControllerInterface
    {
        return $this->routes[strtoupper($method)][$path] ?? $this->createNotFoundController();
    }

    private function createDefaultHttpExceptionHandler(DIContainer $container): HttpExceptionHandlerChainInterface
    {
        $handler = new HandlerDefault();
        $handler->setContainer($container);

        return $handler;
    }

    private function createNotFoundController(): ControllerInterface
    {
        $controller = new NotFoundController();
        $controller->setContainer($this->container);

        return $controller;
    }
}
