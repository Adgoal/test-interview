<?php declare(strict_types=1);

namespace App\Object;

use App\HttpMessage\BadRequestHttpException;
use Psr\Http\Message\RequestInterface;

final class AuthTokenRequest implements AuthTokenRequestInterface
{
    private string $token;

    public function __construct(RequestInterface $request)
    {
        $token = $request->getHeader('Authorization')[0] ?? null;
        if (is_string($token)) {
            $token = substr_replace($token, '', 0, strlen('Bearer '));
        }

        if (!is_string($token) || empty($token)) {
            throw new BadRequestHttpException();
        }

        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
