<?php declare(strict_types=1);

namespace App\Model;

use App\HttpMessage\AccessDeniedException;
use App\HttpMessage\BadRequestHttpException;
use App\HttpMessage\UnauthorizedHttpException;
use App\Object\AuthRequestInterface;
use App\Object\AuthResponse;
use App\Object\AuthTokenRequestInterface;
use App\Service\Auth\AuthServiceInterface;

final class AuthModel implements AuthModelInterface
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function auth(AuthRequestInterface $authRequest): AuthResponse
    {
        if (!$this->authService->checkCredentials($authRequest->getLogin(), $authRequest->getPassword())){
            throw new BadRequestHttpException('Login or password is invalid');
        }

        return new AuthResponse(
            $this->authService->generateToken()
        );
    }

    public function throwExceptionIfInvalidToken(AuthTokenRequestInterface $tokenRequest): void
    {
        try {
            $isExpired = $this->authService->isExpired($tokenRequest->getToken());
        } catch (\Throwable $exception){
            throw new UnauthorizedHttpException('Invalid token');
        }

        if (false === $isExpired){
            throw new AccessDeniedException('Token expired');
        }
    }
}
