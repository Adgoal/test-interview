<?php declare(strict_types=1);

namespace App\Service\Auth;

final class AuthService implements AuthServiceInterface
{
    private string $login;
    private string $password;
    private string $secretKey;
    private int $tokenLifeTime;

    public function __construct(string $login, string $password, string $secretKey, int $tokenLifeTime)
    {
        $this->login = $login;
        $this->password = $password;
        $this->secretKey = $secretKey;
        $this->tokenLifeTime = $tokenLifeTime;
    }

    public function generateToken(): string
    {
        $timestamp = (string)time();

        return base64_encode(sprintf('%s.%s', $timestamp, $this->hash($timestamp)));
    }

    public function isExpired(string $token): bool
    {
        $tokenArr = explode('.', base64_decode($token));

        if (2 !== count($tokenArr)){
            throw new InvalidTokenException();
        }

        $timestamp = $tokenArr[0];
        if ($this->hash($timestamp) !== $tokenArr[1]) {
             throw new InvalidTokenException();
        }

        return time() < ($timestamp + $this->tokenLifeTime);
    }

    public function checkCredentials(string $login, string $password): bool
    {
        return $login === $this->login && $password === $this->password;
    }

    /**
     * @param string $timestamp
     * @return string
     */
    private function hash(string $timestamp): string
    {
        return sprintf('%s', hash_hmac('sha256', $timestamp, $this->secretKey));
    }
}
