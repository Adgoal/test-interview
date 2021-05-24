<?php

namespace Api\Controller\Auth;

use Api\Services\Auth\JWTAuth;
use Api\Services\UserServices;
use http\Env;

class AuthController extends \Controller
{
    public array $request;
    private $userService;

    public function __construct(array $request, UserServices $userService)
    {
       $this->request = $request;
       $this->userService = $userService;
    }

    /**
     * @return false|string
     */
    public function register()
    {
        $login = $this->request['login'] ?? null;
        $password = $this->request['password'] ?? null;

        if (!is_null($login) && !is_null($password))
        {
            $user = $this->userService->existEmail($login);

            if ($user) {
                throw new AuthException(__('auth.user_exists'), self::HTTP_UNAUTHORIZED);
            }
            $user = $this->userService->createUser($login, $password);

            return $this->respondWithToken($user);
        }

        return $this->responseError(['login' => [$login]], self::HTTP_UNAUTHORIZED);
    }


    /**
     * @return mixed
     */
    public function login()
    {
        $login = $this->request['login'] ?? null;
        $password = $this->request['password'] ?? null;

        if (($login == Env::get('USER_LOGIN'))
            && ($password == Env::get('USER_PASSWORD')))
        {
            $user = $this->userService->existEmail($login);

            if (!$user) {
                throw new AuthException(__('auth.user_not_found'), self::HTTP_UNAUTHORIZED);

            }
            return $this->respondWithToken($user);
        }

        return $this->responseError(['login' => [$login]], self::HTTP_UNAUTHORIZED);
    }


    /**
     * @return false|string
     */
    public function refreshTokenAction()
    {
        $refreshToken = $this->request['refresh_token'] ?? null;

        return $this->response([
            'refresh_token' => JWTAuth::getUserFromRefreshToken($refreshToken),
        ]);
    }


    /**
     * @param $token
     * @return false|string
     */
    public function logout($token)
    {
        JWTAuth::blacklist($token);

        return $this->response([
            'message' => __('auth.logout')
        ]);
    }


    /**
     * @param $user
     * @return false|string
     */
    protected function respondWithToken($user)
    {
        return $this->response([
            'token' => JWTAuth::createToken($user),
        ]);
    }
}