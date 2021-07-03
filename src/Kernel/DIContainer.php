<?php declare(strict_types=1);

namespace App\Kernel;

use App\HttpMessage\HttpMessagesFactoryInterface;
use App\HttpMessage\JsonResponseFactoryInterface;
use App\Model\AuthModelInterface;
use App\Model\StatModelInterface;
use Psr\Container\ContainerInterface;

final class DIContainer
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getHttpMessagesFactory(): HttpMessagesFactoryInterface
    {
        return $this->container->get(HttpMessagesFactoryInterface::class);
    }

    public function getJsonResponseFactory(): JsonResponseFactoryInterface
    {
        return $this->container->get(JsonResponseFactoryInterface::class);
    }

    public function getAuthModel(): AuthModelInterface
    {
        return $this->container->get(AuthModelInterface::class);
    }

    public function getStatModel(): StatModelInterface
    {
        return $this->container->get(StatModelInterface::class);
    }
}
