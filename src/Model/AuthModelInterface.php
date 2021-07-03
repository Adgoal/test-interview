<?php declare(strict_types=1);

namespace App\Model;

use App\HttpMessage\AccessDeniedException;
use App\HttpMessage\BadRequestHttpException;
use App\HttpMessage\UnauthorizedHttpException;
use App\Object\AuthRequestInterface;
use App\Object\AuthResponse;
use App\Object\AuthTokenRequestInterface;

interface AuthModelInterface
{
    /**
     * @param AuthRequestInterface $authRequest
     * @throws BadRequestHttpException
     * @return AuthResponse
     */
    public function auth(AuthRequestInterface $authRequest): AuthResponse;

    /**
     * @throws UnauthorizedHttpException
     * @throws AccessDeniedException
     */
    public function throwExceptionIfInvalidToken(AuthTokenRequestInterface $tokenRequest): void;
}
