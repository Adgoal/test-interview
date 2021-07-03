<?php declare(strict_types=1);

namespace App\Object;

use App\HttpMessage\BadRequestHttpException;
use Psr\Http\Message\RequestInterface;

class AuthRequest implements AuthRequestInterface
{
    private string $login;
    private string $password;

    public function __construct(RequestInterface $request)
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $login = $data['login'] ?? null;
        if (!is_string($login) || empty($login)){
            throw new BadRequestHttpException();
        } else {
            $this->login = $login;
        }

        $password = $data['password'] ?? null;
        if (!is_string($password) || empty($password)){
            throw new BadRequestHttpException();
        } else {
            $this->password = $password;
        }
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
