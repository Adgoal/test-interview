<?php declare(strict_types=1);

namespace App\Controller;

use App\Object\AuthRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class LoginController extends ControllerAbstract
{
    public function handleRequest(RequestInterface $request): ResponseInterface
    {
        $data = $this->container->getAuthModel()->auth(new AuthRequest($request));

        return $this->jsonResponse($data);
    }
}
