<?php declare(strict_types=1);

namespace App\HttpMessage;

use Psr\Http\Message\ResponseInterface;

interface JsonResponseFactoryInterface
{
    public function makeJsonResponse(int $status = 200, array $headers = [], string $body = ''): ResponseInterface;
}
