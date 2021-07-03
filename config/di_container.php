<?php declare(strict_types=1);

namespace App;

use App\HttpMessage\GuzzleHttpMessagesFactory;
use App\HttpMessage\HttpMessagesFactoryInterface;
use App\HttpMessage\JsonResponseFactoryInterface;
use App\Kernel\AppParameters;
use App\Model\AuthModel;
use App\Model\AuthModelInterface;
use App\Model\StatModel;
use App\Model\StatModelInterface;
use App\Repository\DefaultRepository;
use App\Repository\StatRepository;
use App\Service\Auth\AuthService;
use App\Service\Auth\AuthServiceInterface;
use League\Container\Container;

return function (Container $container, AppParameters $parameters): void
{
    $container->add(HttpMessagesFactoryInterface::class, GuzzleHttpMessagesFactory::class);
    $container->add(JsonResponseFactoryInterface::class)->setConcrete(HttpMessagesFactoryInterface::class);

    $container->add(AuthServiceInterface::class, AuthService::class)->addArguments([
        $parameters->get('user_login'),
        $parameters->get('user_password'),
        $parameters->get('app_secret_key'),
        $parameters->get('token_life_time'),
    ]);

    $container->add(AuthModelInterface::class, AuthModel::class)->addArguments([
        AuthServiceInterface::class
    ]);

    $container->add(DefaultRepository::class)->addArguments([
        $parameters->get('db_dsn'),
        $parameters->get('db_login'),
        $parameters->get('db_password'),
    ]);
    $container->add(StatRepository::class)->addArgument(DefaultRepository::class);

    $container->add(StatModelInterface::class, StatModel::class)->addArgument(StatRepository::class);
};
