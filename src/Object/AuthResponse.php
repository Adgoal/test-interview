<?php declare(strict_types=1);

namespace App\Object;

final class AuthResponse implements \JsonSerializable
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
