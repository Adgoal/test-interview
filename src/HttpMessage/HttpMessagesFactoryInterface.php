<?php declare(strict_types=1);

namespace App\HttpMessage;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpMessagesFactoryInterface
{
    public function makeResponse(int $status = 200, array $headers = [], string $body = ''): ResponseInterface;

    public function makeRequestFromGlobals(): RequestInterface;
}
