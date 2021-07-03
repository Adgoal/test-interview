<?php declare(strict_types=1);

namespace App;

use App\Kernel\AppParameters;
use App\Kernel\DIContainer;
use App\Kernel\HttpKernel;
use League\Container\Container;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

$config = require __DIR__.'/../config/parameters.php';

$appParameters = new AppParameters(dirname(__DIR__), $config);
$container = new Container();

$containerConf = require(__DIR__.'/../config/di_container.php');
$containerConf($container, $appParameters);

$appContainer = new DIContainer($container);
$kernel = new HttpKernel($appContainer);

$routesConf = require(__DIR__.'/../config/routes.php');
$routesConf($kernel, $appContainer);

$request = $appContainer->getHttpMessagesFactory()->makeRequestFromGlobals();
$response = $kernel->handleRequest($request);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values){
    header(sprintf('%s: %s', $name, implode('; ', $values)), false);
}

echo $response->getBody()->getContents();
