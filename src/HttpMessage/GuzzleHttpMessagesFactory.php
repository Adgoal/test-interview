<?php declare(strict_types=1);

namespace App\HttpMessage;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class GuzzleHttpMessagesFactory implements HttpMessagesFactoryInterface, JsonResponseFactoryInterface
{
    public function makeResponse(int $status = 200, array $headers = [], string $body = ''): ResponseInterface
    {
        return new Response($status, $headers, $body);
    }

    public function makeRequestFromGlobals(): RequestInterface
    {
        return new Request(
            $this->getReqMethod(),
            $this->getReqUrl(),
            $this->getHeaders(),
            $this->getReqBody()
        );
    }

    public function makeJsonResponse(int $status = 200, array $headers = [], string $body = ''): ResponseInterface
    {
        $response = $this->makeResponse($status, $headers, $body);

        return $response->withHeader('Content-Type', 'application/json');
    }

    private function getReqProtocol(): string
    {
        return isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== 'off' ? 'https' : 'http';
    }

    private function getReqMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    private function getReqUri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '';
    }

    private function getReqUrl(): string
    {
        return sprintf('%s://%s%s', $this->getReqProtocol(), $this->getReqHostName(), $this->getReqUri());
    }

    private function getReqHostName(): string
    {
        return $_SERVER['HTTP_HOST'] ?? 'localhost';
    }

    private function getReqBody(): string
    {
        return file_get_contents('php://input');
    }

    private function getHeaders(): array
    {
        if (!is_iterable($_SERVER)) {
            return [];
        }

        foreach ($_SERVER ?? [] as $k => $v) {
            if (!is_string($v)) {
                continue;
            }

            if (0 !== strpos($k, 'HTTP_')) {
                continue;
            }

            $headers[substr_replace($k, '', 0, strlen('HTTP_'))] = $v;
        }

        return $headers ?? [];
    }
}
